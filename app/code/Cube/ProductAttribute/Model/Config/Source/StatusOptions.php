<?php

namespace Cube\ProductAttribute\Model\Config\Source;

use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;

class StatusOptions extends AbstractSource
{
    protected $optionFactory;

    /**
     * @return array|null
     */
    public function getAllOptions()
    {
        $this->_options = [];
        $this->_options[] = ['label' => 'A/C', 'value' => 'ac'];
        $this->_options[] = ['label' => 'DUAL A/C', 'value' => 'dual_ac'];
        $this->_options[] = ['label' => 'ABS', 'value' => 'abs'];
        $this->_options[] = ['label' => 'AIR BAG', 'value' => 'airbag'];
        $this->_options[] = ['label' => 'ALLOYS', 'value' => 'alloys'];
        $this->_options[] = ['label' => 'BACK CAM', 'value' => 'bag_cam'];
        $this->_options[] = ['label' => 'BACK TIRE', 'value' => 'back_tire'];
        $this->_options[] = ['label' => 'CEN LOCK', 'value' => 'cen_lock'];
        $this->_options[] = ['label' => 'CLIMATE', 'value' => 'climate '];
        $this->_options[] = ['label' => 'CRUISE', 'value' => 'cruise'];
        $this->_options[] = ['label' => 'DUAL A/B', 'value' => 'dual_ab'];
        $this->_options[] = ['label' => 'DVD', 'value' => 'dvd'];
        $this->_options[] = ['label' => 'FOGS', 'value' => 'fogs'];
        $this->_options[] = ['label' => 'JACK', 'value' => 'jack'];
        $this->_options[] = ['label' => 'KEY START', 'value' => 'key_start'];
        $this->_options[] = ['label' => 'PUSH START', 'value' => 'push_start'];
        $this->_options[] = ['label' => 'LEATHER SEAT', 'value' => 'leather_seat'];
        $this->_options[] = ['label' => 'P/S DOOR', 'value' => 'ps_door'];
        $this->_options[] = ['label' => 'NAVI', 'value' => 'navi'];
        $this->_options[] = ['label' => 'P/M', 'value' => 'p_m'];
        $this->_options[] = ['label' => 'P/S', 'value' => 'p_s'];
        $this->_options[] = ['label' => 'P/W', 'value' => 'p_w'];
        $this->_options[] = ['label' => 'RADIO', 'value' => 'radio'];
        $this->_options[] = ['label' => 'REAR SPOILER', 'value' => 'rear_spoiler'];
        $this->_options[] = ['label' => 'SPARE TIRE', 'value' => 'spare_tire'];
        $this->_options[] = ['label' => 'SUNROOF', 'value' => 'sunroof'];
        $this->_options[] = ['label' => 'W/S', 'value' => 'w_s'];
        $this->_options[] = ['label' => 'W/M', 'value' => 'w_m'];

        return $this->_options;
    }
}
