<?php
/**
 * @var \App\View\AppView $this
 */
?>
<style type="text/css">
    .containernew {
        border: 2px solid #dedede;
        background-color: #f1f1f1;
        border-radius: 5px;
        padding: 10px;
        /*    margin: 10px 0;*/
    }
    .darker p{
        float: right;
    }
    .darker {
        border-color: #ccc;
        background-color: #ddd;
    }

    .containernew::after {
        content: "";
        clear: both;
        display: table;
    }

    .containernew img {
        float: left;
        max-width: 60px;
        width: 100%;
        margin-right: 20px;
        border-radius: 50%;
    }

    .containernew img.right {
        float: right;
        margin-left: 20px;
        margin-right:0;
    }

    .time-right {
        float: right;
        color: #aaa;
    }

    .time-left {
        float: left;
        color: #999;
    }

    input.textarea {
        bottom: 0px;
        left: 0px;
        right: 0px;
        width: 100%;
        height: 50px;
        z-index: 99;
        background: #fafafa;
        border: none;
        outline: none;
        padding-left: 55px;
        padding-right: 55px;
        color: #666;
        font-weight: 400;
    }
</style>
</head>
<body>
    <div>
        <div class="col-sm-12">
            <h2>Global Messages <?= $this->Html->link('Back',['controller'=>'conversations','action'=>'index'],['class'=>'btn btn-primary float-right']); ?></h2>
            
            <div style="height:450px; overflow:scroll;">
            
            <?php echo $this->Form->create(); ?>
            <div class="containernew">
                <?= $this->Form->input('message',['type'=>'text','class'=>'textarea',"placeholder"=>"Type here!",'label'=>false]); ?>
                <?= $this->Form->input('Send',['type'=>'submit','class'=>'btn btn-primary classsubmit','div'=>FALSE]); ?>
            </div>
            <?php echo $this->Form->end(); ?>
            </div>
        </div>
    </div>
 
<style type="text/css">        
.classsubmit{    
    position: absolute;
    top: 16px;
    right: 19px;
    padding: 2px;
    height: 40px;
    width: 100px;
}
.containernew{ position: relative; margin-top: 5px; }
.containernew p { float: left; }
.content-wrapper{ height: 100%; }
.float-right{ float: right; }
</style>