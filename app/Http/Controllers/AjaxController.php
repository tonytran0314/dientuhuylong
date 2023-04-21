<?php

namespace App\Http\Controllers;
use App\Models\QuanHuyen;
use App\Models\XaPhuongThitran;

use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function showQuanHuyen($idTp) {
        $quanhuyen = QuanHuyen::where('matp', $idTp)->get();
        echo '<option disabled selected>-Chọn Quận/Huyện-</option>';
        foreach ($quanhuyen as $qh) {
            echo "<option value='".$qh->maqh."'>".$qh->name."</option>";
        }
    }

    public function showPhuongXa($idqh) {
        $phuongxa = XaPhuongThitran::where('maqh', $idqh)->get();
        echo '<option disabled selected>-Chọn Phường/Xã-</option>';
        foreach ($phuongxa as $px) {
            echo "<option value='".$px->xaid."'>".$px->name."</option>";
        }
    }
}
