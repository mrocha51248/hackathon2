<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220120141742 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE wish_list (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_5B8739BDA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE wish_list_product (id INT AUTO_INCREMENT NOT NULL, product_id INT NOT NULL, wishlist_id INT NOT NULL, quantity INT NOT NULL, INDEX IDX_9B7C1C9D4584665A (product_id), INDEX IDX_9B7C1C9DFB8E54CD (wishlist_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE wish_list ADD CONSTRAINT FK_5B8739BDA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE wish_list_product ADD CONSTRAINT FK_9B7C1C9D4584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE wish_list_product ADD CONSTRAINT FK_9B7C1C9DFB8E54CD FOREIGN KEY (wishlist_id) REFERENCES wish_list (id)');
        $this->addSql('ALTER TABLE user ADD is_verified TINYINT(1) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE wish_list_product DROP FOREIGN KEY FK_9B7C1C9DFB8E54CD');
        $this->addSql('DROP TABLE wish_list');
        $this->addSql('DROP TABLE wish_list_product');
        $this->addSql('ALTER TABLE `user` DROP is_verified');
    }
}
