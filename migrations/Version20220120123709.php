<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220120123709 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE subscription_product (id INT AUTO_INCREMENT NOT NULL, subscription_id INT NOT NULL, product_id INT NOT NULL, price INT NOT NULL, quantity INT NOT NULL, INDEX IDX_A05FE4369A1887DC (subscription_id), INDEX IDX_A05FE4364584665A (product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE subscription_product ADD CONSTRAINT FK_A05FE4369A1887DC FOREIGN KEY (subscription_id) REFERENCES subscription (id)');
        $this->addSql('ALTER TABLE subscription_product ADD CONSTRAINT FK_A05FE4364584665A FOREIGN KEY (product_id) REFERENCES product (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE subscription_product');
    }
}
