<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use App\Http\Requests\Vendor\StoreVendorRequest;
use App\Http\Requests\Vendor\UpdateVendorRequest;

class VendorController extends ApiController
{
    public function __construct()
    {
        $this->model = new Vendor;
        $this->store_request = new StoreVendorRequest;
        $this->update_request = new UpdateVendorRequest;
    }
}
