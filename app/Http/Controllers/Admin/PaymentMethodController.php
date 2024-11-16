<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ToastNotificationTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PaymentMethodRequest;
use App\Models\PaymentMethod;
use App\Services\PaymentMethodService;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class PaymentMethodController extends Controller
{
    use ToastNotificationTrait;

    protected $paymentMethods;

    const NAMEITEM = 'Medio de pago';

    public function __construct(PaymentMethodService $paymentMethods)
    {
        $this->paymentMethods = $paymentMethods;
        $this->authorizeResource(PaymentMethod::class);
    }

    public function index(): Response
    {
        $filters = request()->all();
        $paymentMethods = $this->paymentMethods->getAll();

        return Inertia::render('Admin/PaymentMethods/Index', compact('paymentMethods', 'filters'));
    }

    public function create(): Response
    {
        return Inertia::render('Admin/PaymentMethods/Create');
    }

    public function store(PaymentMethodRequest $request): RedirectResponse
    {
        $this->paymentMethods->create($request);

        return to_route('payment_methods.index')->with($this->created(nameItem: self::NAMEITEM));
    }

    public function edit(PaymentMethod $paymentMethod): Response
    {
        return Inertia::render('Admin/PaymentMethods/Edit', compact('paymentMethod'));
    }

    public function update(PaymentMethodRequest $request, PaymentMethod $paymentMethod): RedirectResponse
    {
        $this->paymentMethods->update($request, $paymentMethod);

        return to_route('payment_methods.index')->with($this->updated(nameItem: self::NAMEITEM));
    }

    public function destroy(PaymentMethod $paymentMethod): RedirectResponse
    {
        $this->paymentMethods->delete($paymentMethod);

        return to_route('payment_methods.index')->with($this->deleted(nameItem: self::NAMEITEM));
    }
}
