<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use App\Models\Orders;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PdfController extends Controller
{
    public function downloadPdf($orderId)
    {
        $order = Orders::findOrFail($orderId);
        $orderItems = OrderItem::where('order_id', $orderId)->get();
        $pdf = Pdf::loadView('pdf.orders', compact('order','orderItems'));
      
    // Set the filename and path
    $fileName = 'order_' . $order->id . '.pdf';
    $directory = storage_path('app/public/orders/');

    // Check if the directory exists, if not, create it
    if (!file_exists($directory)) {
        mkdir($directory, 0755, true);
    }

    $filePath = $directory . $fileName;

    // Save the PDF to the specified path
    $pdf->save($filePath);

    // Download the PDF
    return response()->download($filePath);
    }
}
