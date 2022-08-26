 <div class="sidebar" data-color="" >
	<!--  Management-->
	<?php if($userType == 1){?>
    	<div class="sidebar-wrapper">
            <div class="logo">
                <a href="index" class="simple-text">
                    <?php echo $system_title; ?>
					
                </a>
				
            </div>
           <ul class="nav">
                <li class="<?php if ($active_page == 'dashboard')echo 'active'; ?>">
                    <a href="dashboard">
                        <i class="entypo-gauge"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
				
				<li class="<?php if ($active_page == 'user'|| $active_page == 'edit_user'|| $active_page == 'new_user'|| $active_page == 'change_user_pass'
				|| $active_page == 'verify_user') echo 'active'; ?> ">
                    <a href="user">
                        <i class="entypo-users"></i>
                        <p>Staff</p>
                    </a>
                </li>

                <li class="<?php if ($active_page == 'product_category' || $active_page == 'new_product_category'|| $active_page == 'edit_product_category') echo 'active'; ?> ">
                    <a href="product_category">
                        <i class="entypo-layout"></i>
                        <p>Item Category</p>
                    </a>
                </li>

                <li class="<?php if ($active_page == 'item' || $active_page == 'new_item' || $active_page == 'edit_item'|| $active_page == 'restock') echo 'active'; ?> ">
                    <a href="item">
                        <i class="entypo-lifebuoy"></i>
                        <p>Items</p>
                    </a>
                </li>

                <li class="<?php if ($active_page == 'sell') echo 'active'; ?> ">
                    <a href="sell">
                        <i class="entypo-cog"></i>
                        <p>Sell Items</p>
                    </a>
                </li>
				
				<li class="<?php if ($active_page == 'sold_by') echo 'active'; ?> ">
                    <a href="sold_by">
                        <i class="entypo-cog"></i>
                        <p>Your Sales</p>
                    </a>
                </li>
				
				<li class="<?php if ($active_page == 'served') echo 'active'; ?> ">
                    <a href="served">
                        <i class="entypo-cog"></i>
                        <p>Served</p>
                    </a>
                </li>
				
				<li class="<?php if ($active_page == 'account') echo 'active'; ?> ">
                    <a href="account">
                        <i class="entypo-cog"></i>
                        <p>Account</p>
                    </a>
                </li>
				
				<li class="<?php if ($active_page == 'Analyze') echo 'active'; ?> ">
                    <a href="analyze">
                        <i class="entypo-cog"></i>
                        <p>Analysis</p>
                    </a>
                </li>
				
				<li class="<?php if ($active_page == 'kitchen') echo 'active'; ?> ">
                    <a href="kitchen">
                        <i class="entypo-cog"></i>
                        <p>Kitchen</p>
                    </a>
                </li>


            </ul>
    	</div>
	<!-- /Management-->
	
	 <?php }elseif($userType == 2){?>
	 <!-- Retail-->
		<div class="sidebar-wrapper">
            <div class="logo">
                <a href="index" class="simple-text">
                    <?php echo $system_title; ?>
                </a>
            </div>
           <ul class="nav">
               
				<li class="<?php if ($active_page == 'kitchen') echo 'active'; ?> ">
                    <a href="kitchen">
                        <i class="entypo-cog"></i>
                        <p>Kitchen</p>
                    </a>
                </li>
				
				<li class="<?php if ($active_page == 'served') echo 'active'; ?> ">
                    <a href="served">
                        <i class="entypo-cog"></i>
                        <p>Served</p>
                    </a>
                </li>
				
				
            </ul>
    	</div>
	
	 <!-- /Retail-->
	  <?php }elseif($userType == 3){?>
	  <!-- Kitchen-->
	  <div class="sidebar-wrapper">
            <div class="logo">
                <a href="index" class="simple-text">
                    <?php echo $system_title; ?>
					
                </a>
				
            </div>
           <ul class="nav">
                <li class="<?php if ($active_page == 'sell') echo 'active'; ?> ">
                    <a href="sell">
                        <i class="entypo-cog"></i>
                        <p>Sell Items</p>
                    </a>
                </li>
				
				<li class="<?php if ($active_page == 'sold_by') echo 'active'; ?> ">
                    <a href="sold_by">
                        <i class="entypo-cog"></i>
                        <p>Sold By You</p>
                    </a>
                </li>
				
            </ul>
    	</div>
	
		
	 <!-- /Kitchen-->
	 <?php }?>
	</div>
