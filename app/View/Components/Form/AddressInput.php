<?php

namespace App\View\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AddressInput extends Component
{
    public  $key, $editable, $postcodes, $states, $countries,$addressTypes;
    public function __construct($key, $editable, $postcodes, $states, $countries,$addressTypes)
    {
        $this->key        = $key;
        $this->editable   = $editable;
        $this->postcodes  = $postcodes;
        $this->states     = $states;
        $this->countries  = $countries;
        $this->addressTypes  = $addressTypes;
    }

    public function render(): View|Closure|string
    {
        return view('components.form.address-input');
    }
}
