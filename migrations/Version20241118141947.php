<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241118141947 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE contacts (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE coups (id INT AUTO_INCREMENT NOT NULL, numero_coup INT NOT NULL, coup VARCHAR(500) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messages (id INT AUTO_INCREMENT NOT NULL, contenu VARCHAR(255) NOT NULL, date_envoi DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE parties (id INT AUTO_INCREMENT NOT NULL, resultat VARCHAR(50) NOT NULL, type_partie VARCHAR(50) NOT NULL, coups VARCHAR(500) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE parties_coups (parties_id INT NOT NULL, coups_id INT NOT NULL, INDEX IDX_1ED62406362AAF23 (parties_id), INDEX IDX_1ED6240640F2BD0 (coups_id), PRIMARY KEY(parties_id, coups_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rating (id INT AUTO_INCREMENT NOT NULL, user_id_id INT DEFAULT NULL, rating_bullet INT DEFAULT NULL, rating_blitz INT DEFAULT NULL, rating_rapide INT DEFAULT NULL, INDEX IDX_D88926229D86650F (user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, message_id_id INT DEFAULT NULL, username VARCHAR(50) NOT NULL, email VARCHAR(50) NOT NULL, password_hash VARCHAR(255) NOT NULL, date_inscription DATE NOT NULL, pays VARCHAR(50) NOT NULL, INDEX IDX_1483A5E980E261BC (message_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users_contacts (users_id INT NOT NULL, contacts_id INT NOT NULL, INDEX IDX_48013EA967B3B43D (users_id), INDEX IDX_48013EA9719FB48E (contacts_id), PRIMARY KEY(users_id, contacts_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users_parties (users_id INT NOT NULL, parties_id INT NOT NULL, INDEX IDX_B3636CCF67B3B43D (users_id), INDEX IDX_B3636CCF362AAF23 (parties_id), PRIMARY KEY(users_id, parties_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE parties_coups ADD CONSTRAINT FK_1ED62406362AAF23 FOREIGN KEY (parties_id) REFERENCES parties (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE parties_coups ADD CONSTRAINT FK_1ED6240640F2BD0 FOREIGN KEY (coups_id) REFERENCES coups (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE rating ADD CONSTRAINT FK_D88926229D86650F FOREIGN KEY (user_id_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT FK_1483A5E980E261BC FOREIGN KEY (message_id_id) REFERENCES messages (id)');
        $this->addSql('ALTER TABLE users_contacts ADD CONSTRAINT FK_48013EA967B3B43D FOREIGN KEY (users_id) REFERENCES users (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE users_contacts ADD CONSTRAINT FK_48013EA9719FB48E FOREIGN KEY (contacts_id) REFERENCES contacts (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE users_parties ADD CONSTRAINT FK_B3636CCF67B3B43D FOREIGN KEY (users_id) REFERENCES users (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE users_parties ADD CONSTRAINT FK_B3636CCF362AAF23 FOREIGN KEY (parties_id) REFERENCES parties (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE parties_coups DROP FOREIGN KEY FK_1ED62406362AAF23');
        $this->addSql('ALTER TABLE parties_coups DROP FOREIGN KEY FK_1ED6240640F2BD0');
        $this->addSql('ALTER TABLE rating DROP FOREIGN KEY FK_D88926229D86650F');
        $this->addSql('ALTER TABLE users DROP FOREIGN KEY FK_1483A5E980E261BC');
        $this->addSql('ALTER TABLE users_contacts DROP FOREIGN KEY FK_48013EA967B3B43D');
        $this->addSql('ALTER TABLE users_contacts DROP FOREIGN KEY FK_48013EA9719FB48E');
        $this->addSql('ALTER TABLE users_parties DROP FOREIGN KEY FK_B3636CCF67B3B43D');
        $this->addSql('ALTER TABLE users_parties DROP FOREIGN KEY FK_B3636CCF362AAF23');
        $this->addSql('DROP TABLE contacts');
        $this->addSql('DROP TABLE coups');
        $this->addSql('DROP TABLE messages');
        $this->addSql('DROP TABLE parties');
        $this->addSql('DROP TABLE parties_coups');
        $this->addSql('DROP TABLE rating');
        $this->addSql('DROP TABLE users');
        $this->addSql('DROP TABLE users_contacts');
        $this->addSql('DROP TABLE users_parties');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
