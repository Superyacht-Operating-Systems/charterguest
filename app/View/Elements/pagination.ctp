<?php
/**
 * 4
 */
//echo ">>>>>>>>>>>>>>".$PaginationPanel; exit;
//$count = $this->Paginator->params->paging['Templatechecklist']['count'];

/*if($count>SHOW_PER_PAGE)
{*/
// Inside the view
// If necessary, set the jQuery object for noconflict
$this->Js->JqueryEngine->jQueryObject = 'jQuery';
// Paginator options


?>

<ul class="pagination margin0 pull-left">
               	<?php echo $this->Paginator->prev(__('<span>&laquo;</span>'), array('tag' => 'li', 'escape' => false)); ?>
               	<?php echo $this->Paginator->numbers( array('before' => '',
														    'after' => '',
														    'separator' => '',
														    'tag' => 'li',
														    'currentClass' => 'active', 
														    'currentTag' => 'span' , 
														    'escape' => false,
														    'class' => 'number'
														    )); ?>
               	<?php echo $this->Paginator->next(__('<span>&raquo;</span>'), array('tag' => 'li', 'escape' => false)); ?>
               	
               	
</ul>

<?php
// }
?>
<?php echo $this->Js->writeBuffer(); ?>
