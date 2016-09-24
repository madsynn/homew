@extends('frontend.layout.layout')

@inject('products', 'App\Models\Product')


@section('content')

<link rel="stylesheet" type="text/css" href="/assets/css/bootstrap-combined.min.css">
<style type="text/css">

.tree{min-height:20px;padding:19px;margin-bottom:20px;background-color:#fbfbfb;border:1px solid #999;-webkit-border-radius:4px;-moz-border-radius:4px;border-radius:4px;-webkit-box-shadow:inset 0 1px 1px rgba(0,0,0,0.05);-moz-box-shadow:inset 0 1px 1px rgba(0,0,0,0.05);box-shadow:inset 0 1px 1px rgba(0,0,0,0.05)}
.tree li{list-style-type:none;margin:0;padding:10px 5px 0 5px;position:relative}
.tree li::before,.tree li::after{content:'';left:-20px;position:absolute;right:auto}
.tree li::before{border-left:1px solid #999;bottom:50px;height:100%;top:0;width:1px}
.tree li::after{border-top:1px solid #999;height:20px;top:25px;width:25px}
.tree li span{-moz-border-radius:5px;-webkit-border-radius:5px;border:1px solid #999;border-radius:5px;display:inline-block;padding:3px 8px;text-decoration:none}
.tree li.parent_li>span{cursor:pointer}
.tree>ul>li::before,.tree>ul>li::after{border:0}
.tree li:last-child::before{height:30px}
.tree li.parent_li>span:hover,.tree li.parent_li>span:hover+ul li span{background:#eee;border:1px solid #94a0b4;color:#000}

</style>
<div class="section-wrapper page-heading ">
	<h3>Welcome to Dashboard</h3>
</div>


<?php


//    function philsroutes()
//    {
//        $routeCollection = Route::getRoutes();
//        echo '<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.1/css/bootstrap-combined.min.css">';
//        echo "<div class='container'><div class='col-md-12'><table class='table table-striped' style='width:100%'>";
//        echo '<tr>';
//        echo "<td width='10%'><h4>HTTP Method</h4></td>";
//        echo "<td width='30%'><h4>URL</h4></td>";
//        echo "<td width='30%'><h4>Route</h4></td>";
//        echo "<td width='30%'><h4>Corresponding Action</h4></td>";
//        echo '</tr>';
//        foreach ($routeCollection as $value)
//        {
//            echo '<tr>';
//            echo '<td>' . $value->getMethods()[0] . '</td>';
//            echo "<td><a href='" . $value->getPath() . "' target='_blank'>" . $value->getPath() . '</a> </td>';
//            echo '<td>' . $value->getName() . '</td>';
//            echo '<td>' . $value->getActionName() . '</td>';
//            echo '</tr>';
//        }
//        echo '</table></div></div>';
//        echo '<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>';
//    }
//    return philsroutes();


//$routeCollection = Route::getRoutes();//

//foreach ($routeCollection as $value) {
//    echo $value->getPath();
//}

//foreach (Route::getRoutes() as $route) {
//    $compiled = $route->getCompiled();
//    if(!is_null($compiled))
//    {
//        var_dump($compiled->getStaticPrefix());
//    }
//}


$routeCollection = Route::getRoutes();//

$current = \Request::route()->getName();

$children = $current->getChildren();
 var_dump($children);

foreach ($routeCollection as $value) {
    // echo $value->getName();
    //var_dump($value->getName());


}
// \Request::route()->getName()

// outputProducts();












 ?>

<div class="tree well">
	<ul>
		<li>
			<span><i class="icon-folder-open"></i> Parent</span> <a href="">Goes somewhere</a>
			<ul>
				<li>
					<span><i class="icon-minus-sign"></i> Child</span> <a href="">Goes somewhere</a>
					<ul>
						<li>
							<span><i class="icon-leaf"></i> Grand Child</span> <a href="">Goes somewhere</a>
						</li>
					</ul>
				</li>
				<li>
					<span><i class="icon-minus-sign"></i> Child</span> <a href="">Goes somewhere</a>
					<ul>
						<li>
							<span><i class="icon-leaf"></i> Grand Child</span> <a href="">Goes somewhere</a>
						</li>
						<li>
							<span><i class="icon-minus-sign"></i> Grand Child</span> <a href="">Goes somewhere</a>
							<ul>
								<li>
									<span><i class="icon-minus-sign"></i> Great Grand Child</span> <a href="">Goes somewhere</a>
									<ul>
										<li>
											<span><i class="icon-leaf"></i> Great great Grand Child</span> <a href="">Goes somewhere</a>
										</li>
										<li>
											<span><i class="icon-leaf"></i> Great great Grand Child</span> <a href="">Goes somewhere</a>
										</li>
									</ul>
								</li>
								<li>
									<span><i class="icon-leaf"></i> Great Grand Child</span> <a href="">Goes somewhere</a>
								</li>
								<li>
									<span><i class="icon-leaf"></i> Great Grand Child</span> <a href="">Goes somewhere</a>
								</li>
							</ul>
						</li>
						<li>
							<span><i class="icon-leaf"></i> Grand Child</span> <a href="">Goes somewhere</a>
						</li>
					</ul>
				</li>
			</ul>
		</li>
		<li>
			<span><i class="icon-folder-open"></i> Parent2</span> <a href="">Goes somewhere</a>
			<ul>
				<li>
					<span><i class="icon-leaf"></i> Child</span> <a href="">Goes somewhere</a>
				</li>
			</ul>
		</li>
	</ul>
</div>



<script language="javascript" type="text/javascript">

$(function () {
    $('.tree li:has(ul)').addClass('parent_li').find(' > span').attr('title', 'Collapse this branch');
    $('.tree li.parent_li > span').on('click', function (e) {
        var children = $(this).parent('li.parent_li').find(' > ul > li');
        if (children.is(":visible")) {
            children.hide('fast');
            $(this).attr('title', 'Expand this branch').find(' > i').addClass('icon-plus-sign').removeClass('icon-minus-sign');
        } else {
            children.show('fast');
            $(this).attr('title', 'Collapse this branch').find(' > i').addClass('icon-minus-sign').removeClass('icon-plus-sign');
        }
        e.stopPropagation();
    });
});

jQuery(document).ready(function($){

});

</script>

@endsection
