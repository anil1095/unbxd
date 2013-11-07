<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title><?php echo $product->name;?></title>
    <style>
    	.container h2{
    		padding: 10px 0px 0px;
    		margin: 0px;
    	}
    	
    	.container table, .container tr, .container td{
    		border: 1px solid;
    		border-collapse:collapse;
    	}
    	
    	.sno{
    		width: 50px;
    	}
    	
    	.pri{
    		width: 50px;
    	}
    	
    	.shp{
    		width: 200px;
    	}
    	
    	.tr{
    		text-align: right;
    	}
    	
    	.tc{
    		text-align: center;
    	}
    </style>
  </head>
  <body>
    <div class="container">
    	<h2><?php echo $product->name;?></h2>
    	<small><?php echo $product->store.' - '.$cats[0]['cat_name'].' > '.$cats[1]['cat_name'];?></small>
    	<br>
    	<p>
    		<?php if(sizeof($models) == 1){?>
    			Only one version is available for this product in store.
    		<?php }else{?>
    			There are <?php echo sizeof($models);?> verients available for this product in store.
    		<?php }?>
    	</p>
    	<table>
    		<thead>
    			<tr>
    				<td class="sno tc">
    					S. No
    				</td>
    				<td class="pri tc">
    					Price
    				</td>
    				<td class="shp tc">
    					Shipping Duration
    				</td>
    			</tr>
    		</thead>
    		<tbody>
    			<?php foreach($models as $k => $v){?>
    			<tr>
    				<td class="sno tr">
    					<?php echo $k + 1;?>
    				</td>
    				<td class="pri tr">
    					<?php echo $v->price;?>
    				</td>
    				<td class="shp tc">
    					<?php echo $v->shipping_duration;?>
    				</td>
    			</tr>
    			<?php } ?>
    		</tbody>
    	</table>
    </div>
  </body>
</html>
