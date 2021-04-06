<?php

namespace App\Http\Controllers;

use App\Enumeration\FilePathEnumeration;
use App\Http\Requests\DisplayStoreRequest;
use App\Http\Resources\CustomJsonResource;
use App\Http\Resources\DisplayCollection;
use App\Http\Resources\DisplayResource;
use App\Http\Resources\DisplayTypeCollection;
use App\Http\Resources\ErrorResource;
use App\Http\Resources\MessageResource;
use App\Http\Resources\ResellerCollection;
use App\Models\Display;
use App\Models\DisplayType;
use App\Models\Reseller;
use App\Traits\ResponseTrait;
use App\Traits\StoreFileTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DisplayController extends Controller
{
    use ResponseTrait;
    use StoreFileTrait;

    public function getSetup(Request $request)
    {
        $setup['resellers'] = new ResellerCollection(Reseller::all());
        $setup['display_types'] = new DisplayTypeCollection(DisplayType::all());
        return new CustomJsonResource($setup);
    }

    public function get(Request $request)
    {
        $paginator = Display::query()->with(['displayType', 'reseller', 'image'])->paginate(10, '*', 'page', $request->page ?? 1);
        return new DisplayCollection($paginator);
    }

    public function fetch(Request $request)
    {
        $display = Display::query()->find($request->route('id'));

        if (!$display) {
            return $this->notFoundResponse(Display::class);
        }

        return new DisplayResource($display);
    }

    public function store(DisplayStoreRequest $request)
    {
        $fileId = $this->storeFile($request, 'file', FilePathEnumeration::DISPLAY_IMAGES);
        $display = new Display([
            'serial_number' => $request->input('serial_number'),
            'display_type_id' => $request->input('display_type'),
            'reseller_id' => $request->input('reseller'),
            'file_id' => $fileId ? $fileId : null
        ]);
        $display->save();
        return new DisplayResource($display);
    }

    public function delete(Request $request)
    {
        $display = Display::query()->find($request->route('id'));

        if (!$display) {
            return $this->notFoundResponse(Display::class);
        }

        // could add a warning to response if there was an image and it couldn't be deleted
        if ($display->image) {
            $display->image->delete();
        }

        return $display->delete()
            ? new MessageResource(__('response.delete_success', ['object' => __('models.display')]))
            : new ErrorResource([
                "messages" => __('response.delete_failed', ['object' => __('models.display')]),
                "status" => Response::HTTP_INTERNAL_SERVER_ERROR
            ]);
    }
}
