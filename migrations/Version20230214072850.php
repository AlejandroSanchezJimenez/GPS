<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230214072850 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE mensaje (id INT AUTO_INCREMENT NOT NULL, usuario_id INT NOT NULL, banda_id INT NOT NULL, modo_id INT NOT NULL, fecha_hora_mensaje DATE NOT NULL, INDEX IDX_9B631D01DB38439E (usuario_id), INDEX IDX_9B631D019EFB0C1D (banda_id), INDEX IDX_9B631D011858652E (modo_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE mensaje ADD CONSTRAINT FK_9B631D01DB38439E FOREIGN KEY (usuario_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE mensaje ADD CONSTRAINT FK_9B631D019EFB0C1D FOREIGN KEY (banda_id) REFERENCES banda (id)');
        $this->addSql('ALTER TABLE mensaje ADD CONSTRAINT FK_9B631D011858652E FOREIGN KEY (modo_id) REFERENCES modo (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE mensaje DROP FOREIGN KEY FK_9B631D01DB38439E');
        $this->addSql('ALTER TABLE mensaje DROP FOREIGN KEY FK_9B631D019EFB0C1D');
        $this->addSql('ALTER TABLE mensaje DROP FOREIGN KEY FK_9B631D011858652E');
        $this->addSql('DROP TABLE mensaje');
    }
}
