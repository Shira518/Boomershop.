<?php include "header.php" ?>
<?php include "connexion_bdd.php" ?>		
<?php
	if(isset($_GET["action"]) and $_GET["action"] == 'empty'){
		unset($_SESSION["cart_item"]);

		//comment
	}	
	
	else if(isset($_GET["id"]) and isset($_GET["quantity"])) { 
		$resultat = mysqli_query($bdd,"SELECT * FROM product WHERE id='" . $_GET["id"] . "'");
		
		$productByCode = mysqli_fetch_assoc($resultat);

		

		$itemArray = array($productByCode["id"]=>array('libelle'=>$productByCode["libelle"], 'id'=>$productByCode["id"], 'quantity'=>$_GET["quantity"], 'prix'=>$productByCode["prix"], 'image'=>$productByCode["image"]));
		
		if(!empty($_SESSION["cart_item"])) {
			if(in_array($productByCode["id"],array_keys($_SESSION["cart_item"]))) {
				foreach($_SESSION["cart_item"] as $k => $v) {
						if($productByCode["id"] == $k) {
							if(empty($_SESSION["cart_item"][$k]["quantity"])) {
								$_SESSION["cart_item"][$k]["quantity"] = 0;
							}
							echo 'MAJ Qte';
							$_SESSION["cart_item"][$k]["quantity"] += $_GET["quantity"];
						}
				}
			} else {
				echo 'panier non vide : nouvel ajout';
				$_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
			}
		} else {
			echo 'panier était vide';
			$_SESSION["cart_item"] = $itemArray;
		}
	}
?>


		<!-- Search Panel -->
		<div class="search_panel trans_300">
			<div class="container">
				<div class="row">
					<div class="col">
						<div class="search_panel_content d-flex flex-row align-items-center justify-content-end">
							<form action="#">
								<input type="text" class="search_input" placeholder="Search" required="required">
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Social -->
		<div class="header_social">
			<ul>
				<li><a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
				<li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
				<li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
				<li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
			</ul>
		</div>
	</header>

	<!-- Menu -->

	<div class="menu menu_mm trans_300">
		<div class="menu_container menu_mm">
			<div class="page_menu_content">
							
				<div class="page_menu_search menu_mm">
					<form action="#">
						<input type="search" required="required" class="page_menu_search_input menu_mm" placeholder="Search for products...">
					</form>
				</div>
				<ul class="page_menu_nav menu_mm">
					<li class="page_menu_item has-children menu_mm">
						<a href="index.php">Home<i class="fa fa-angle-down"></i></a>
						<ul class="page_menu_selection menu_mm">
							<li class="page_menu_item menu_mm"><a href="categories.php">Categories<i class="fa fa-angle-down"></i></a></li>
							<li class="page_menu_item menu_mm"><a href="product.php">Product<i class="fa fa-angle-down"></i></a></li>
							<li class="page_menu_item menu_mm"><a href="cart.php">Cart<i class="fa fa-angle-down"></i></a></li>
							<li class="page_menu_item menu_mm"><a href="checkout.php">Checkout<i class="fa fa-angle-down"></i></a></li>
							<li class="page_menu_item menu_mm"><a href="contact.php">Contact<i class="fa fa-angle-down"></i></a></li>
						</ul>
					</li>
					<li class="page_menu_item has-children menu_mm">
						<a href="categories.html">Categories<i class="fa fa-angle-down"></i></a>
						<ul class="page_menu_selection menu_mm">
							<li class="page_menu_item menu_mm"><a href="categories.php">Category<i class="fa fa-angle-down"></i></a></li>
							<li class="page_menu_item menu_mm"><a href="categories.php">Category<i class="fa fa-angle-down"></i></a></li>
							<li class="page_menu_item menu_mm"><a href="categories.php">Category<i class="fa fa-angle-down"></i></a></li>
							<li class="page_menu_item menu_mm"><a href="categories.php">Category<i class="fa fa-angle-down"></i></a></li>
						</ul>
					</li>
					<li class="page_menu_item menu_mm"><a href="index.php">Accessories<i class="fa fa-angle-down"></i></a></li>
					<li class="page_menu_item menu_mm"><a href="#">Offers<i class="fa fa-angle-down"></i></a></li>
					<li class="page_menu_item menu_mm"><a href="contact.php">Contact<i class="fa fa-angle-down"></i></a></li>
				</ul>
			</div>
		</div>

		<div class="menu_close"><i class="fa fa-times" aria-hidden="true"></i></div>

		<div class="menu_social">
			<ul>
				<li><a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
				<li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
				<li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
				<li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
			</ul>
		</div>
	</div>
	
	<!-- Home -->

	<div class="home">
		<div class="home_container">
			<div class="home_background" style="background-image:url(images/cart.jpg)"></div>
			<div class="home_content_container">
				<div class="container">
					<div class="row">
						<div class="col">
							<div class="home_content">
								<div class="breadcrumbs">
									<ul>
										<li><a href="index.php">Accueil</a></li>
										<li><a href="categories.php">Catégories</a></li>
										<li>Mon Panier</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Cart Info -->

	<div class="cart_info">
		<div class="container">
			<div class="row">
				<div class="col">
					<!-- Column Titles -->
					<div class="cart_info_columns clearfix">
						<div class="cart_info_col cart_info_col_product">Produit</div>
						<div class="cart_info_col cart_info_col_price">Prix</div>
						<div class="cart_info_col cart_info_col_quantity">Quantité</div>
						<div class="cart_info_col cart_info_col_total">Total</div>
					</div>
				</div>
			</div>
			<div class="row cart_items_row">
				<div class="col">

				<?php

					if(empty($_SESSION["cart_item"])) {
				?>
		
					<div class="cart_item d-flex flex-lg-row flex-column align-items-lg-center align-items-start justify-content-start">
						<!-- Name -->
						<div class="cart_item_product d-flex flex-row align-items-center justify-content-start">

								panier vide!!

						</div>
					</div>
				<?php

				}else 
				foreach($_SESSION["cart_item"] as $k => $v) {
						
				?>

					<!-- Cart Item -->
					<div class="cart_item d-flex flex-lg-row flex-column align-items-lg-center align-items-start justify-content-start">
						<!-- Name -->
						<div class="cart_item_product d-flex flex-row align-items-center justify-content-start">
							<div class="cart_item_image">
								<div><img src="<?php echo $_SESSION["cart_item"][$k]["image"]; ?>" alt=""></div>
							</div>
							<div class="cart_item_name_container">
								<div class="cart_item_name"><a href="detail_product.php?id=<?php echo $_SESSION["cart_item"][$k]["id"]; ?>"><?php echo $_SESSION["cart_item"][$k]["libelle"] ; ?></a></div>
								<div class="cart_item_edit"><a href="#">Edit Product</a></div>
							</div>
						</div>
						<!-- Price -->
						<div class="cart_item_price"><?php echo $_SESSION["cart_item"][$k]["prix"]; ?> </div>
						<!-- Quantity -->
						<div class="cart_item_quantity">
							<div class="product_quantity_container">
								<div class="product_quantity clearfix">
									<span>Qté</span>
									<input id="quantity_input" type="text" pattern="[0-9]*" value="<?php echo $_SESSION["cart_item"][$k]["quantity"]; ?> ">
									<div class="quantity_buttons">
										<div id="quantity_inc_button" class="quantity_inc quantity_control"><i class="fa fa-chevron-up" aria-hidden="true"></i></div>
										<div id="quantity_dec_button" class="quantity_dec quantity_control"><i class="fa fa-chevron-down" aria-hidden="true"></i></div>
									</div>
								</div>
							</div>
						</div>
						<!-- Total -->
						<div class="cart_item_total"><?php echo $_SESSION["cart_item"][$k]["quantity"] * $_SESSION["cart_item"][$k]["prix"]; ?> </div>
					</div>

				<?php
				}
				?>

				</div>
			</div>
			<div class="row row_cart_buttons">
				<div class="col">
					<div class="cart_buttons d-flex flex-lg-row flex-column align-items-start justify-content-start">
						<div class="button continue_shopping_button"><a href="#">Continuer mes achats</a></div>
						<div class="cart_buttons_right ml-lg-auto">
							<div class="button clear_cart_button"><a href="?action=empty">Vider le panier</a></div>
						</div>
					</div>
				</div>
			</div>
			<div class="row row_extra">
				<div class="col-lg-4">
					
					<!-- Delivery -->
					<div class="delivery">
						<div class="section_title">Options de livraison</div>
						<div class="section_subtitle">Selectionnez le type de livraison désiré</div>
						<div class="delivery_options">
							<label class="delivery_option clearfix">Livraison en un jour ouvré
								<input type="radio" name="radio">
								<span class="checkmark"></span>
								<span class="delivery_price">9.99€</span>
							</label>
							<label class="delivery_option clearfix">Livraison standard
								<input type="radio" name="radio">
								<span class="checkmark"></span>
								<span class="delivery_price">4,99€</span>
							</label>
							<label class="delivery_option clearfix">Relais colis
								<input type="radio" checked="checked" name="radio">
								<span class="checkmark"></span>
								<span class="delivery_price">Offert</span>
							</label>
						</div>
					</div>

					<!-- Coupon Code -->
					<div class="coupon">
						<div class="section_title">Vous avez un code promo? :)</div>
						<div class="section_subtitle">Saisissez le ici</div>
						<div class="coupon_form_container">
							<form action="#" id="coupon_form" class="coupon_form">
								<input type="text" class="coupon_input" required="required">
								<button class="button coupon_button"><span>Appliquer</span></button>
							</form>
						</div>
					</div>
				</div>

				<div class="col-lg-6 offset-lg-2">
					<div class="cart_total">
						<div class="section_title">Récapitulatif</div>
						<div class="cart_total_container">
							<ul>
								<li class="d-flex flex-row align-items-center justify-content-start">
									<div class="cart_total_title">Sous total</div>
									<div class="cart_total_value ml-auto">$790.90</div>
								</li>
								<li class="d-flex flex-row align-items-center justify-content-start">
									<div class="cart_total_title">Livraison</div>
									<div class="cart_total_value ml-auto">Free</div>
								</li>
								<li class="d-flex flex-row align-items-center justify-content-start">
									<div class="cart_total_title">Total</div>
									<div class="cart_total_value ml-auto">$790.90</div>
								</li>
							</ul>
						</div>
						<div class="button checkout_button"><a href="#">Procéder au paiement</a></div>
					</div>
				</div>
			</div>
		</div>		
	</div>

	<!-- Footer -->
	
<?php include "footer.php" ?>