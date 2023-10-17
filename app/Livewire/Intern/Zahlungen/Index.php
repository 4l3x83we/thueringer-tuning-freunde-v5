<?php

namespace App\Livewire\Intern\Zahlungen;

use App\Models\Intern\Payment;
use Carbon\Carbon;
use Livewire\Component;

class Index extends Component
{
    public $zahlungen;

    public $zahlungGesamt;

    public $years;

    public function mount()
    {
        $this->zahlungen = Payment::whereBetween('payment_for_month', [now()->subYears(date('Y') - 2017), now()->addYear()])
            ->orderBy('payment_for_month', 'DESC')
            ->get()
            ->groupBy(function ($val) {
                return Carbon::parse($val->payment_for_month)->isoFormat('MMMM YYYY');
            });
        /*$this->zahlungen = Payment::whereBetween('payment_for_month', [now()->subYears(date('Y') - 2017), now()->addYear()])
            ->orderBy('payment_for_month', 'DESC')
            ->get()
            ->groupBy(function ($val) {
                return Carbon::parse($val->payment_for_month)->isoFormat('MMMM YYYY');
            });
        $this->zahlungGesamt = number_format(Payment::where('bezahlt', true)->sum('betrag'), 2, ',', '.').' €';
        $this->years = Payment::selectRaw('year(payment_for_month) year')
            ->groupBy('year')
            ->orderBy('year', 'DESC')
            ->get();*/
    }

    /*public function pay($id, $status)
    {
        if ($status) {
            Payment::where('id', $id)->update(['bezahlt' => $status, 'date_of_payment' => now()->format('Y-m-d')]);
        } else {
            Payment::where('id', $id)->update(['bezahlt' => $status, 'date_of_payment' => null]);
        }

        return redirect(route('intern.zahlungen.index'));
    }*/

    /*public function bezahlt()
    {
        dd(123);
    }*/

    public function render()
    {
        return view('livewire.intern.zahlungen.index');
    }
}
