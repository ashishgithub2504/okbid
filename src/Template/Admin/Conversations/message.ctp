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
        float: right !important;
    }
    .darker {
        border-color: #ccc;
        background-color: #E4CA8F;
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
            <h2>Chat Messages <?= $this->Html->link('Back',['controller'=>'conversations','action'=>'index'],['class'=>'btn btn-primary float-right']); ?></h2>
            
            <div id="loadchats" style="height:600px; overflow:scroll; background-color: #fff; padding: 10px;">
                <?php if(!empty($mess)){
                    
                    foreach ($mess['chats'] as $key=>$val){
                        $class = 'darker';
                        $time = 'time-left';
                       if($auth != $val['sender_id']){
                           $class = '';
                           $time = 'time-right';
                       }
                ?>
            <div class="containernew <?= $class; ?>">
                <p><?= !empty($val['chat'])?$val['chat']:''; ?>
                    <b>(<?= $this->Custom->getUserName($val['sender_id']); ?>)</b>
                </p>
                <span class="<?= $time; ?>"><?= date('d-M-Y H:i A',strtotime($val['created'])); ?></span>
            </div>
            <?php } }
            
            ?>
                
            </div>
            
            <?php echo $this->Form->create(); ?>
                <div class="containernew">
                    <?= $this->Form->input('user_id',['type'=>'hidden','value'=>$mess['user_id']]); ?>
                    <?= $this->Form->input('message',['type'=>'text','class'=>'textarea',"autocomplete"=>"off","placeholder"=>"Type here!",'label'=>false]); ?>
                    <?= $this->Form->input('Send',['type'=>'submit','class'=>'btn btn-primary classsubmit','div'=>false]); ?>
                </div>
            <?php echo $this->Form->end(); ?>
            
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
<script type="text/javascript">
    $(function () {

        setInterval(function () {

            $.ajax({
                url: baseurl + "admin/conversations/messageload/<?php echo $id; ?>",
                cache: false,
                success: function (html) {
                    $("#loadchats").html(html);
                }
            });
        }, 5000);

    });
</script>