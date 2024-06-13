<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240606114847 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F5299398E05B374B');
        $this->addSql('DROP INDEX IDX_F5299398E05B374B ON `order`');
        $this->addSql('ALTER TABLE `order` DROP adress_delivery_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `order` ADD adress_delivery_id INT NOT NULL');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F5299398E05B374B FOREIGN KEY (adress_delivery_id) REFERENCES adress (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_F5299398E05B374B ON `order` (adress_delivery_id)');
    }
}
