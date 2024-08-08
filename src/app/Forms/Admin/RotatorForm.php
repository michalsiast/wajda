<?php


namespace App\Forms\Admin;


use App\Helpers\Form;
use App\Models\Article;
use App\Models\BaseModel;
use App\Models\Offer;
use App\Models\OfferCategory;
use App\Models\Page;
use App\Models\PageType;
use App\Models\Rotator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class RotatorForm extends Form
{

    const FIELDS = [
        'title' => [
            'name' => 'title',
            'type' => 'text',
            'label' => 'Nazwa rotatora',
            'rules' => ['max:255', 'min:2', 'required'],
        ],
        'speed' => [
            'name' => 'speed',
            'type' => 'text',
            'label' => 'Czas/Prędkość przejścia [ms]',
            'rules' => ['max:10', 'min:2', 'required'],
        ],
        'time' => [
            'name' => 'time',
            'type' => 'text',
            'label' => 'Czas trwania slajdu [ms] ',
            'rules' => ['max:10', 'min:2', 'required'],
        ],
        'pager' => [
            'name' => 'pager',
            'type' => 'checkbox',
            'label' => 'Pager (kropki oznaczające dany slajd)',
            'rules' => [],
            'options' => [],
        ],
        'arrows' => [
            'name' => 'arrows',
            'type' => 'checkbox',
            'label' => 'Strzałki na slajderze',
            'rules' => [],
            'options' => [],
        ],
        'active' => [
            'name' => 'active',
            'type' => 'checkbox',
            'label' => 'admin.active',
            'rules' => [],
            'options' => [],
        ],
    ];

    public function __construct($model = null)
    {
        foreach (self::FIELDS as $name => $field) {
            $this->modelFields[$name] = $field;
        }

        parent::__construct($model, Rotator::class);
    }
}
