<hr />

    <div class="row">
    <?php echo form_open(site_url('admin/actualizar_frase') ,
      array('class' => 'form-horizontal form-groups-bordered','target'=>'_top'));?>
        <div class="col-md-12">

            <div class="panel panel-primary" >

                <div class="panel-heading">
                    <div class="panel-title">
                        <?php echo "Actualizar Frase";?>
                    </div>
                </div>

                <div class="panel-body">

                  <div class="form-group">
                      <label  class="col-sm-3 control-label"><?php echo "Frase";?></label>
                      <div class="col-sm-9">
                          <input type="text" required="true" class="form-control" name="frase"
                              value="<?php echo $frases->frase;?>" required>
                      </div>
                  </div>


                  <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-9">
                        <button type="submit" class="btn btn-info"><?php echo get_phrase('save');?></button>
                    </div>
                  </div>
                    <?php echo form_close();?>

                </div>

            </div>



        </div>

        </div>
    </div>
<style media="screen">
.container {

}

.control-group {
display: inline-block;
vertical-align: top;
background: #fff;
text-align: left;
box-shadow: 0 1px 2px rgba(0,0,0,0.1);
padding: 30px;
width: 200px;
height: 210px;
margin: 10px;
}
.control {
display: block;
position: relative;
padding-left: 40px;
margin-bottom: 15px;
cursor: pointer;
font-size: 18px;
}
.control input {
position: absolute;
z-index: -1;
opacity: 0;
}
.control__indicator {
position: absolute;
top: 2px;
left: -11px;
height: 20px;
width: 20px;
background: #e6e6e6;
}
.control--radio .control__indicator {
border-radius: 50%;
}
.control:hover input ~ .control__indicator,
.control input:focus ~ .control__indicator {
background: #ccc;
}
.control input:checked ~ .control__indicator {
background: #2aa1c0;
}
.control:hover input:not([disabled]):checked ~ .control__indicator,
.control input:checked:focus ~ .control__indicator {
background: #0e647d;
}
.control input:disabled ~ .control__indicator {
background: #e6e6e6;
opacity: 0.6;
pointer-events: none;
}
.control__indicator:after {
content: '';
position: absolute;
display: none;
}
.control input:checked ~ .control__indicator:after {
display: block;
}
.control--checkbox .control__indicator:after {
      left: 8px;
      top: 5px;
      width: 4px;
      height: 9px;
      border: 3px solid #fff;
      border-width: 0 2px 2px 0;
      transform: rotate(45deg);
}
.control--checkbox input:disabled ~ .control__indicator:after {
border-color: #7b7b7b;
}


</style>
