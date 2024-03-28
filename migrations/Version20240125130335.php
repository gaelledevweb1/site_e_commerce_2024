<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240125130335 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE article_blog (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, categories_blog_id INT NOT NULL, title VARCHAR(255) NOT NULL, contain LONGTEXT NOT NULL, author VARCHAR(255) NOT NULL, date_creation DATE NOT NULL, INDEX IDX_7057D642A76ED395 (user_id), INDEX IDX_7057D642F2EAAF37 (categories_blog_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cart (id INT AUTO_INCREMENT NOT NULL, article_quantity INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categories_blog (id INT AUTO_INCREMENT NOT NULL, name_category VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name_category VARCHAR(255) NOT NULL, category_images VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE comments_blog (id INT AUTO_INCREMENT NOT NULL, article_blog_id INT DEFAULT NULL, user_id INT DEFAULT NULL, comments VARCHAR(255) NOT NULL, author VARCHAR(255) NOT NULL, date_creation DATE NOT NULL, INDEX IDX_44C47CE437323A20 (article_blog_id), INDEX IDX_44C47CE4A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `order` (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, order_date DATE NOT NULL, paid TINYINT(1) NOT NULL, status VARCHAR(255) NOT NULL, delivered TINYINT(1) NOT NULL, delivery_date DATE NOT NULL, delivery_info VARCHAR(255) NOT NULL, INDEX IDX_F5299398A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE paiement (id INT AUTO_INCREMENT NOT NULL, bank_name VARCHAR(255) NOT NULL, card_name VARCHAR(255) NOT NULL, card_number VARCHAR(255) NOT NULL, card_network VARCHAR(255) NOT NULL, card_holdername VARCHAR(255) NOT NULL, expiration_date DATE NOT NULL, cvccode INT NOT NULL, security_card VARCHAR(255) NOT NULL, currency VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE products (id INT AUTO_INCREMENT NOT NULL, categories_blog_id INT DEFAULT NULL, category_id INT DEFAULT NULL, article_ref VARCHAR(255) NOT NULL, article_name VARCHAR(255) NOT NULL, article_images VARCHAR(255) NOT NULL, article_thumbnails VARCHAR(255) DEFAULT NULL, article_stock_quantity INT NOT NULL, article_description LONGTEXT NOT NULL, bought_price DOUBLE PRECISION NOT NULL, sell_price_ht DOUBLE PRECISION NOT NULL, sell_price_ttc DOUBLE PRECISION NOT NULL, tva DOUBLE PRECISION NOT NULL, details VARCHAR(255) NOT NULL, INDEX IDX_B3BA5A5AF2EAAF37 (categories_blog_id), INDEX IDX_B3BA5A5A12469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, cart_id INT DEFAULT NULL, paiement_id INT NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, zip INT NOT NULL, country VARCHAR(255) NOT NULL, phone INT NOT NULL, birthday DATE NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, confirm_password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D6491AD5CDBF (cart_id), UNIQUE INDEX UNIQ_8D93D6492A4C4478 (paiement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE article_blog ADD CONSTRAINT FK_7057D642A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE article_blog ADD CONSTRAINT FK_7057D642F2EAAF37 FOREIGN KEY (categories_blog_id) REFERENCES categories_blog (id)');
        $this->addSql('ALTER TABLE comments_blog ADD CONSTRAINT FK_44C47CE437323A20 FOREIGN KEY (article_blog_id) REFERENCES article_blog (id)');
        $this->addSql('ALTER TABLE comments_blog ADD CONSTRAINT FK_44C47CE4A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F5299398A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE products ADD CONSTRAINT FK_B3BA5A5AF2EAAF37 FOREIGN KEY (categories_blog_id) REFERENCES categories_blog (id)');
        $this->addSql('ALTER TABLE products ADD CONSTRAINT FK_B3BA5A5A12469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6491AD5CDBF FOREIGN KEY (cart_id) REFERENCES cart (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6492A4C4478 FOREIGN KEY (paiement_id) REFERENCES paiement (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article_blog DROP FOREIGN KEY FK_7057D642A76ED395');
        $this->addSql('ALTER TABLE article_blog DROP FOREIGN KEY FK_7057D642F2EAAF37');
        $this->addSql('ALTER TABLE comments_blog DROP FOREIGN KEY FK_44C47CE437323A20');
        $this->addSql('ALTER TABLE comments_blog DROP FOREIGN KEY FK_44C47CE4A76ED395');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F5299398A76ED395');
        $this->addSql('ALTER TABLE products DROP FOREIGN KEY FK_B3BA5A5AF2EAAF37');
        $this->addSql('ALTER TABLE products DROP FOREIGN KEY FK_B3BA5A5A12469DE2');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6491AD5CDBF');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6492A4C4478');
        $this->addSql('DROP TABLE article_blog');
        $this->addSql('DROP TABLE cart');
        $this->addSql('DROP TABLE categories_blog');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE comments_blog');
        $this->addSql('DROP TABLE `order`');
        $this->addSql('DROP TABLE paiement');
        $this->addSql('DROP TABLE products');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
