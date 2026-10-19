<?php
namespace App\Controllers\Admin;

use App\Models\Inventory;

class InventoryController extends AdminController
{
    /**
     * Show Inventory Management Table
     */
    public function index()
    {
        $status = $_GET['status'] ?? 'all';
        $search = trim($_GET['search'] ?? '');

        $inventory = Inventory::getInventoryList($status, $search);

        $this->render('admin.inventory.index', [
            'page_title' => 'Inventory Management',
            'current_admin_page' => 'inventory',
            'page_script' => 'inventory.js',
            'inventory' => $inventory,
            'current_status' => $status,
            'search_query' => $search,
            'success' => get_flash('success'),
            'error' => get_flash('error')
        ]);
    }

    /**
     * Handle single or batch stock adjustments (AJAX or standard POST)
     */
    public function update()
    {
        $isAjax = (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') 
                  || (isset($_SERVER['CONTENT_TYPE']) && strpos($_SERVER['CONTENT_TYPE'], 'application/json') !== false);

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            if ($isAjax) {
                header('Content-Type: application/json');
                echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
                exit;
            }
            $this->redirect('admin/inventory');
        }

        // Support JSON body or standard POST
        $rawData = file_get_contents('php://input');
        $jsonData = json_decode($rawData, true);

        if (!empty($jsonData['adjustments']) && is_array($jsonData['adjustments'])) {
            $adjustments = $jsonData['adjustments'];
        } elseif (!empty($_POST['adjustments']) && is_array($_POST['adjustments'])) {
            $adjustments = $_POST['adjustments'];
        } elseif (isset($_POST['id']) && isset($_POST['adjustment'])) {
            $adjustments = [[
                'type' => $_POST['type'] ?? 'variant',
                'id' => $_POST['id'],
                'adjustment' => $_POST['adjustment']
            ]];
        } else {
            $adjustments = [];
        }

        if (empty($adjustments)) {
            if ($isAjax) {
                header('Content-Type: application/json');
                echo json_encode(['success' => false, 'message' => 'No adjustments provided.']);
                exit;
            }
            set_flash('error', 'No stock changes were made.');
            $this->redirect('admin/inventory');
        }

        $results = Inventory::batchAdjust($adjustments);

        if ($isAjax) {
            header('Content-Type: application/json');
            echo json_encode([
                'success' => true,
                'message' => 'Inventory adjustments applied successfully.',
                'results' => $results
            ]);
            exit;
        }

        set_flash('success', 'Inventory adjustments updated successfully.');
        $this->redirect('admin/inventory');
    }
}
