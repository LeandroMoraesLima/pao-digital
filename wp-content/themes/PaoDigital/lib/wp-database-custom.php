<?php 

	global $jal_db_version;
	$jal_db_version = '1.0';

	function jal_install() {

		global $wpdb;
		global $jal_db_version;
		
		$charset_collate = $wpdb->get_charset_collate();

		$sql = "
		CREATE TABLE `pd_padarias` (
		  `id` INT NOT NULL AUTO_INCREMENT,
		  `post_id` INT NOT NULL,
		  `name` VARCHAR(45) NULL,
		  `content` VARCHAR(45) NULL,
		  `state` INT(5) NULL,
		  `city` INT(5) NULL,
		  `street` VARCHAR(255) NULL,
		  `number` VARCHAR(45) NULL,
		  `district` VARCHAR(255) NULL,
		  `phone` VARCHAR(45) NULL,
		  `email` VARCHAR(45) NULL,
		  `created_at` DATETIME NULL DEFAULT '0000-00-00 00:00:00',
		  `deleted_at` VARCHAR(45) NULL,
		  PRIMARY KEY (`id`))
		ENGINE = InnoDB;";

		$sql1 = "
		CREATE TABLE `pd_sales` (
		  `id` INT NOT NULL AUTO_INCREMENT,
		  `pd_users_ID` BIGINT(20) UNSIGNED NOT NULL,
		  `pd_padarias_id` INT NOT NULL,
		  `preco_total` DECIMAL(10,2) NOT NULL,
		  `desconto` DECIMAL(10,2) NULL,
		  `tax` DECIMAL(10,2) NULL,
		  `payment_status` INT(2) NULL,
		  `product_type` ENUM('drive', 'home') NULL DEFAULT 'home',
		  `package_type` ENUM('junior', 'pleno', 'master', 'menu') NULL DEFAULT 'junior',
		  `package_for_x_days` ENUM('0', '15', '30', '90') NULL DEFAULT '0',
		  `week_time` ENUM('A', 'B', 'C', 'D') NULL DEFAULT 'A',
		  `drive_time` DATETIME NULL DEFAULT '0000-00-00 00:00:00',
		  `phone` VARCHAR(45) NULL,
		  `created_at` DATETIME NULL DEFAULT '0000-00-00 00:00:00',
		  `expiration_at` DATETIME NULL DEFAULT '0000-00-00 00:00:00',
		  `confirmed_at` DATETIME NULL DEFAULT '0000-00-00 00:00:00',
		  PRIMARY KEY (`id`))
		  -- INDEX `fk_pd_sales_pd_users1_idx` (`pd_users_ID` ASC),
		  -- INDEX `fk_pd_sales_pd_padarias1_idx` (`pd_padarias_id` ASC),
		  -- CONSTRAINT `fk_pd_sales_pd_users1`
		  --   FOREIGN KEY (`pd_users_ID`)
		  --   REFERENCES `pd_users` (`ID`)
		  --   ON DELETE NO ACTION
		  --   ON UPDATE NO ACTION,
		  -- CONSTRAINT `fk_pd_sales_pd_padarias1`
		  --   FOREIGN KEY (`pd_padarias_id`)
		  --   REFERENCES `pd_padarias` (`id`)
		  --   ON DELETE NO ACTION
		  --   ON UPDATE NO ACTION)
		ENGINE = InnoDB;";

		$sql2 = "
		CREATE TABLE `pd_produtos` (
		  `id` INT NOT NULL AUTO_INCREMENT,
		  `post_id` INT NOT NULL,
		  `name` VARCHAR(45) NULL,
		  `descricao` VARCHAR(45) NULL,
		  `valor_de_venda` DECIMAL(10,2) NULL,
		  `custo_unitario` DECIMAL(10,2) NULL,
		  `image` MEDIUMTEXT NULL,
		  `created_at` DATETIME NULL DEFAULT '0000-00-00 00:00:00',
		  `deleted_at` DATETIME NULL,
		  PRIMARY KEY (`id`))
		ENGINE = InnoDB;";

		$sql4 = "
		CREATE TABLE `pd_funcionarios` (
		  `id` INT NOT NULL AUTO_INCREMENT,
		  `pd_padarias_id` INT NOT NULL,
		  `pd_users_ID` BIGINT(20) UNSIGNED NOT NULL,
		  PRIMARY KEY (`id`),
		  INDEX `fk_pd_funcionarios_pd_padarias1_idx` (`pd_padarias_id` ASC),
		  INDEX `fk_pd_funcionarios_pd_users1_idx` (`pd_users_ID` ASC),
		  CONSTRAINT `fk_pd_funcionarios_pd_padarias1`
		    FOREIGN KEY (`pd_padarias_id`)
		    REFERENCES `pd_padarias` (`id`)
		    ON DELETE NO ACTION
		    ON UPDATE NO ACTION,
		  CONSTRAINT `fk_pd_funcionarios_pd_users1`
		    FOREIGN KEY (`pd_users_ID`)
		    REFERENCES `pd_users` (`ID`)
		    ON DELETE NO ACTION
		    ON UPDATE NO ACTION)
		ENGINE = InnoDB;";

		$sql5 = "
		CREATE TABLE `pd_openning` (
		  `id` INT NOT NULL,
		  `pd_padarias_id` INT NOT NULL,
		  `mon_start` TIME NULL DEFAULT '00:00:00',
		  `mon_end` TIME NULL DEFAULT '00:00:00',
		  `tue_start` TIME NULL DEFAULT '00:00:00',
		  `tue_end` TIME NULL DEFAULT '00:00:00',
		  `wed_start` TIME NULL DEFAULT '00:00:00',
		  `wed_end` TIME NULL DEFAULT '00:00:00',
		  `thu_start` TIME NULL DEFAULT '00:00:00',
		  `thu_end` TIME NULL DEFAULT '00:00:00',
		  `fri_start` TIME NULL,
		  `fri_end` TIME NULL,
		  `sat_start` TIME NULL,
		  `sat_end` TIME NULL,
		  `sun_start` TIME NULL,
		  `sun_end` TIME NULL,
		  `created_at` DATETIME NULL DEFAULT '0000-00-00 00:00:00',
		  PRIMARY KEY (`id`),
		  INDEX `fk_openning_pd_padarias1_idx` (`pd_padarias_id` ASC),
		  CONSTRAINT `fk_openning_pd_padarias1`
		    FOREIGN KEY (`pd_padarias_id`)
		    REFERENCES `pd_padarias` (`id`)
		    ON DELETE NO ACTION
		    ON UPDATE NO ACTION)
		ENGINE = InnoDB;
		";

		$sql3 = "
		CREATE TABLE `pd_sales_produtos` (
		  `id` INT NOT NULL AUTO_INCREMENT,
		  `pd_sales_id` INT NOT NULL,
		  `pd_produtos_id` INT NOT NULL,
		  `quantity` INT NULL,
		  `valor_total` DECIMAL(10,2) NULL,
		  `created_at` DATETIME NULL DEFAULT '0000-00-00 00:00:00',
		  PRIMARY KEY (`id`))
		  -- INDEX `fk_pd_sales_produtos_pd_produtos1_idx` (`pd_produtos_id` ASC),
		  -- INDEX `fk_pd_sales_produtos_pd_sales_idx` (`pd_sales_id` ASC),
		  -- CONSTRAINT `fk_pd_sales_produtos_pd_sales`
		  --   FOREIGN KEY (`pd_sales_id`)
		  --   REFERENCES `pd_sales` (`id`)
		  --   ON DELETE NO ACTION
		  --   ON UPDATE NO ACTION,
		  -- CONSTRAINT `fk_pd_sales_produtos_pd_produtos1`
		  --   FOREIGN KEY (`pd_produtos_id`)
		  --   REFERENCES `pd_produtos` (`id`)
		  --   ON DELETE NO ACTION
		  --   ON UPDATE NO ACTION)
		ENGINE = InnoDB;";


		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $sql );
		dbDelta( $sql1 );
		dbDelta( $sql2 );
		dbDelta( $sql3 );
		dbDelta( $sql4 );
		dbDelta( $sql5 );

		add_option( 'jal_db_version', $jal_db_version );

	}

	add_action("after_switch_theme", "jal_install");

	