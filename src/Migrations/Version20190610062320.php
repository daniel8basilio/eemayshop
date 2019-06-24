<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190610062320 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Create initial data.';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        // Shop Information
        $this->addSql("INSERT INTO tbl_shop_info(name, email, contact_number, address, established_date, note, slogan) VALUES(
            'Eemay Shop',
            'emmayshop@sample.com',
            '09123456789',
            'Calamba City, Laguna',
            '2019-01-01',
            '',
            'Pre-loved items <3'
        )");

        // Initial users
        $this->addSql("INSERT INTO tbl_users(id, name, email, password, admin, created_at, updated_at)
            VALUES(1, 'Emma', 'emmayshop@sample.com', 'pass1234', true, now(), now())");
        $this->addSql("INSERT INTO tbl_users(name, email, password, admin, created_at, updated_at)
            VALUES('Rusty', 'rusty@sample.com', 'pass1234', false, now(), now())");

        // Product Status
        $this->addSql("INSERT INTO tbl_product_status VALUES(1, 'Reserved')");
        $this->addSql("INSERT INTO tbl_product_status VALUES(2, 'Unavailable')");
        $this->addSql("INSERT INTO tbl_product_status VALUES(3, 'Available')");
        $this->addSql("INSERT INTO tbl_product_status VALUES(4, 'Slightly damaged')");

        // Order Status
        $this->addSql("INSERT INTO tbl_order_status VALUES(1, 'Unpaid')");
        $this->addSql("INSERT INTO tbl_order_status VALUES(2, 'Paid')");
        $this->addSql("INSERT INTO tbl_order_status VALUES(3, 'Canceled')");
        $this->addSql("INSERT INTO tbl_order_status VALUES(4, 'Done')");
        $this->addSql("INSERT INTO tbl_order_status VALUES(5, 'Shipped')");
        $this->addSql("INSERT INTO tbl_order_status VALUES(6, 'Received')");

        // Product Category
        $this->addSql("INSERT INTO tbl_product_category VALUES(1, 'Blouse')");
        $this->addSql("INSERT INTO tbl_product_category VALUES(2, 'Cosmetics')");
        $this->addSql("INSERT INTO tbl_product_category VALUES(3, 'Toys')");
        $this->addSql("INSERT INTO tbl_product_category VALUES(4, 'Pants')");

        // Payment Method
        $this->addSql("INSERT INTO tbl_payment_method VALUES(1, 'Cash On Delivery')");
        $this->addSql("INSERT INTO tbl_payment_method VALUES(2, 'Bayad Center')");

        // Shipping Method
        $this->addSql("INSERT INTO tbl_product_status VALUES(3, 'DoBlack Arrow')");
        $this->addSql("INSERT INTO tbl_product_status VALUES(4, 'Meet up')");
        $this->addSql("INSERT INTO tbl_product_status VALUES(5, 'Ninjavan')");

    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
