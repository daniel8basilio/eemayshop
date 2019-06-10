<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190610062246 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Create tables';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE mst_payment_methods_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE tbl_order_payments_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE tbl_order_details_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE tbl_products_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE tbl_orders_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE tbl_shippings_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE tbl_users_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE mst_order_status_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE mst_shipping_methods_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE tbl_customers_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE mst_product_status_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE tbl_customer_addresses_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE mst_product_categories_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE tbl_shop_info_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE mst_payment_methods (id INT NOT NULL, name TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE tbl_order_payments (id INT NOT NULL, related_order_id INT NOT NULL, method_id INT NOT NULL, amount NUMERIC(10, 0) DEFAULT \'0\' NOT NULL, payment_date TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_13E1326E2B1C2395 ON tbl_order_payments (related_order_id)');
        $this->addSql('CREATE INDEX IDX_13E1326E19883967 ON tbl_order_payments (method_id)');
        $this->addSql('CREATE TABLE tbl_order_details (id INT NOT NULL, related_order_id INT NOT NULL, product_id INT NOT NULL, quantity INT DEFAULT 0 NOT NULL, price NUMERIC(10, 0) DEFAULT \'0\' NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_9DCEC7CA2B1C2395 ON tbl_order_details (related_order_id)');
        $this->addSql('CREATE INDEX IDX_9DCEC7CA4584665A ON tbl_order_details (product_id)');
        $this->addSql('CREATE TABLE tbl_products (id INT NOT NULL, code VARCHAR(20) NOT NULL, name TEXT NOT NULL, price NUMERIC(10, 0) DEFAULT \'0\' NOT NULL, stock INT DEFAULT 0 NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE tbl_orders (id INT NOT NULL, customer_name TEXT DEFAULT NULL, customer_email TEXT DEFAULT NULL, customer_contact_number TEXT DEFAULT NULL, payment_due_date DATE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE tbl_shippings (id INT NOT NULL, address TEXT NOT NULL, name TEXT NOT NULL, contact_number TEXT NOT NULL, postal_code VARCHAR(10) DEFAULT NULL, fee NUMERIC(10, 0) DEFAULT \'0\' NOT NULL, shipping_date DATE DEFAULT NULL, cancel_date DATE DEFAULT NULL, receive_date DATE DEFAULT NULL, tracking_code TEXT DEFAULT NULL, remarks TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE tbl_users (id INT NOT NULL, name TEXT NOT NULL, email TEXT NOT NULL, password TEXT NOT NULL, admin BOOLEAN DEFAULT \'false\' NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE mst_order_status (id INT NOT NULL, name TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE mst_shipping_methods (id INT NOT NULL, name TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE tbl_customers (id INT NOT NULL, fname TEXT NOT NULL, mname TEXT DEFAULT NULL, lname TEXT NOT NULL, email TEXT NOT NULL, contact_number TEXT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE mst_product_status (id INT NOT NULL, name TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE tbl_customer_addresses (id INT NOT NULL, customer_id INT NOT NULL, type TEXT DEFAULT NULL, name TEXT NOT NULL, base_address TEXT NOT NULL, barangay TEXT NOT NULL, city TEXT NOT NULL, country VARCHAR(50) NOT NULL, postal_code VARCHAR(10) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_DA887EAA9395C3F3 ON tbl_customer_addresses (customer_id)');
        $this->addSql('CREATE TABLE mst_product_categories (id INT NOT NULL, name TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE tbl_shop_info (id INT NOT NULL, name TEXT NOT NULL, email TEXT DEFAULT NULL, contact_number TEXT DEFAULT NULL, address TEXT DEFAULT NULL, established_date DATE DEFAULT NULL, note TEXT DEFAULT NULL, slogan TEXT DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE tbl_order_payments ADD CONSTRAINT FK_13E1326E2B1C2395 FOREIGN KEY (related_order_id) REFERENCES tbl_orders (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tbl_order_payments ADD CONSTRAINT FK_13E1326E19883967 FOREIGN KEY (method_id) REFERENCES mst_payment_methods (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tbl_order_details ADD CONSTRAINT FK_9DCEC7CA2B1C2395 FOREIGN KEY (related_order_id) REFERENCES tbl_orders (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tbl_order_details ADD CONSTRAINT FK_9DCEC7CA4584665A FOREIGN KEY (product_id) REFERENCES tbl_products (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tbl_customer_addresses ADD CONSTRAINT FK_DA887EAA9395C3F3 FOREIGN KEY (customer_id) REFERENCES tbl_customers (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE tbl_order_payments DROP CONSTRAINT FK_13E1326E19883967');
        $this->addSql('ALTER TABLE tbl_order_details DROP CONSTRAINT FK_9DCEC7CA4584665A');
        $this->addSql('ALTER TABLE tbl_order_payments DROP CONSTRAINT FK_13E1326E2B1C2395');
        $this->addSql('ALTER TABLE tbl_order_details DROP CONSTRAINT FK_9DCEC7CA2B1C2395');
        $this->addSql('ALTER TABLE tbl_customer_addresses DROP CONSTRAINT FK_DA887EAA9395C3F3');
        $this->addSql('DROP SEQUENCE mst_payment_methods_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE tbl_order_payments_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE tbl_order_details_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE tbl_products_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE tbl_orders_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE tbl_shippings_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE tbl_users_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE mst_order_status_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE mst_shipping_methods_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE tbl_customers_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE mst_product_status_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE tbl_customer_addresses_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE mst_product_categories_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE tbl_shop_info_id_seq CASCADE');
        $this->addSql('DROP TABLE mst_payment_methods');
        $this->addSql('DROP TABLE tbl_order_payments');
        $this->addSql('DROP TABLE tbl_order_details');
        $this->addSql('DROP TABLE tbl_products');
        $this->addSql('DROP TABLE tbl_orders');
        $this->addSql('DROP TABLE tbl_shippings');
        $this->addSql('DROP TABLE tbl_users');
        $this->addSql('DROP TABLE mst_order_status');
        $this->addSql('DROP TABLE mst_shipping_methods');
        $this->addSql('DROP TABLE tbl_customers');
        $this->addSql('DROP TABLE mst_product_status');
        $this->addSql('DROP TABLE tbl_customer_addresses');
        $this->addSql('DROP TABLE mst_product_categories');
        $this->addSql('DROP TABLE tbl_shop_info');
    }
}
