<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200323230021 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD17E8A46A');
        $this->addSql('DROP INDEX UNIQ_D34A04AD17E8A46A ON product');
        $this->addSql('ALTER TABLE product DROP orderdetail_id, CHANGE create_at create_at VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F529939817E8A46A');
        $this->addSql('DROP INDEX UNIQ_F529939817E8A46A ON `order`');
        $this->addSql('ALTER TABLE `order` DROP orderdetail_id');
        $this->addSql('ALTER TABLE orderdetail ADD product_id INT NOT NULL, ADD prodorder_id INT NOT NULL');
        $this->addSql('ALTER TABLE orderdetail ADD CONSTRAINT FK_27A0E7F24584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE orderdetail ADD CONSTRAINT FK_27A0E7F2300F91AD FOREIGN KEY (prodorder_id) REFERENCES `order` (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_27A0E7F24584665A ON orderdetail (product_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_27A0E7F2300F91AD ON orderdetail (prodorder_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE `order` ADD orderdetail_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F529939817E8A46A FOREIGN KEY (orderdetail_id) REFERENCES orderdetail (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F529939817E8A46A ON `order` (orderdetail_id)');
        $this->addSql('ALTER TABLE orderdetail DROP FOREIGN KEY FK_27A0E7F24584665A');
        $this->addSql('ALTER TABLE orderdetail DROP FOREIGN KEY FK_27A0E7F2300F91AD');
        $this->addSql('DROP INDEX UNIQ_27A0E7F24584665A ON orderdetail');
        $this->addSql('DROP INDEX UNIQ_27A0E7F2300F91AD ON orderdetail');
        $this->addSql('ALTER TABLE orderdetail DROP product_id, DROP prodorder_id');
        $this->addSql('ALTER TABLE product ADD orderdetail_id INT DEFAULT NULL, CHANGE create_at create_at DATE NOT NULL');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD17E8A46A FOREIGN KEY (orderdetail_id) REFERENCES orderdetail (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D34A04AD17E8A46A ON product (orderdetail_id)');
    }
}
