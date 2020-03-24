<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200323122110 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE orderdetail (id INT AUTO_INCREMENT NOT NULL, quantity INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('DROP TABLE article');
        $this->addSql('ALTER TABLE product ADD orderdetail_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD17E8A46A FOREIGN KEY (orderdetail_id) REFERENCES orderdetail (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D34A04AD17E8A46A ON product (orderdetail_id)');
        $this->addSql('ALTER TABLE `order` ADD orderdetail_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F529939817E8A46A FOREIGN KEY (orderdetail_id) REFERENCES orderdetail (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F529939817E8A46A ON `order` (orderdetail_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD17E8A46A');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F529939817E8A46A');
        $this->addSql('CREATE TABLE article (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE orderdetail');
        $this->addSql('DROP INDEX UNIQ_F529939817E8A46A ON `order`');
        $this->addSql('ALTER TABLE `order` DROP orderdetail_id');
        $this->addSql('DROP INDEX UNIQ_D34A04AD17E8A46A ON product');
        $this->addSql('ALTER TABLE product DROP orderdetail_id');
    }
}
