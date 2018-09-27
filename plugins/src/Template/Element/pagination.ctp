<ul class="pagination">
    <?php echo $this->Paginator->prev('<i class="fa fa-angle-left"></i>', array('class' => 'disabled previous_page','escape'=>false)); ?>
    <?php echo $this->Paginator->numbers(array('separator' => '', 'currentClass' => 'current')); ?>
    <?php echo $this->Paginator->next('<i class="fa fa-angle-right"></i>', array('class' => 'next_page','escape'=>false)); ?>
</ul>