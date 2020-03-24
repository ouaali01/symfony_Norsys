<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200323230343 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE orderdetail ADD CONSTRAINT FK_27A0E7F24584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE orderdetail ADD CONSTRAINT FK_27A0E7F2300F91AD FOREIGN KEY (prodorder_id) REFERENCES `order` (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_27A0E7F24584665A ON orderdetail (product_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_27A0E7F2300F91AD ON orderdetail (prodorder_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE orderdetail DROP FOREIGN KEY FK_27A0E7F24584665A');
        $this->addSql('ALTER TABLE orderdetail DROP FOREIGN KEY FK_27A0E7F2300F91AD');
        $this->addSql('DROP INDEX UNIQ_27A0E7F24584665A ON orderdetail');
        $this->addSql('DROP INDEX UNIQ_27A0E7F2300F91AD ON orderdetail');
    }
}
