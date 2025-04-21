<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ActionButtons extends Component
{
    public $id;

    public $editRoute;

    public $editModal;

    public $loadEditModal;

    public $loadEditModalRoute;

    public $deleteRoute;

    public $viewRoute;

    public $viewModal;

    public $downloadRoute;

    public $pdfRoute;

    public $mailRoute;

    public $showView;

    public $showViewModal;

    public $showDownload;

    public $showPdf;

    public $showMail;

    public $returnItemRoute;

    public $returnItemModal;

    public $ledgerModal;

    public $ledgerModalRoute;

    public $payLedgerModal;

    public $payLedgerModalRoute;

    public $permission;

    /**
     * Create a new component instance.
     */
    public function __construct(
        int $id,
        ?string $editRoute = null,
        ?string $editModal = null,
        ?string $loadEditModal = null,
        ?string $loadEditModalRoute = null,
        ?string $ledgerModal = null,
        ?string $ledgerModalRoute = null,
        ?string $payLedgerModal = null,
        ?string $payLedgerModalRoute = null,
        ?string $deleteRoute = null,
        ?string $viewRoute = null,
        ?string $viewModal = null,
        ?string $downloadRoute = null,
        ?string $pdfRoute = null,
        ?string $mailRoute = null,
        ?string $returnItemRoute = null,
        ?string $returnItemModal = null,
        bool $showView = false,
        bool $showViewModal = false,
        bool $showDownload = false,
        bool $showPdf = false,
        bool $showMail = false,
        bool $permission = false
    ) {
        $this->id = $id;
        $this->editRoute = $editRoute;
        $this->editModal = $editModal;
        $this->loadEditModal = $loadEditModal;
        $this->loadEditModalRoute = $loadEditModalRoute;
        $this->deleteRoute = $deleteRoute;
        $this->viewRoute = $viewRoute;
        $this->viewModal = $viewModal;
        $this->downloadRoute = $downloadRoute;
        $this->pdfRoute = $pdfRoute;
        $this->mailRoute = $mailRoute;

        $this->showView = $showView;
        $this->showViewModal = $showViewModal;
        $this->showDownload = $showDownload;
        $this->showPdf = $showPdf;
        $this->showMail = $showMail;

        $this->returnItemRoute = $returnItemRoute;
        $this->returnItemModal = $returnItemModal;
        $this->ledgerModalRoute = $ledgerModalRoute;
        $this->ledgerModal = $ledgerModal;
        $this->payLedgerModal = $payLedgerModal;
        $this->payLedgerModalRoute = $payLedgerModalRoute;
        $this->permission = $permission;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.action-buttons');
    }
}
