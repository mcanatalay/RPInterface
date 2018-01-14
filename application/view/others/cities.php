<option value="0"><?= $this->Text->get('CITY_ALL') ?></option>
<?php foreach($this->cities as $city){ ?>
<option <?php if($this->selected == $city->city_id){echo'selected';} ?> value="<?= $city->city_id ?>"><?= $city->city_name ?></option>
<?php } ?>

