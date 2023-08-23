<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230823145645 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE club_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE club_member_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE game_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE game_leaderboard_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE game_session_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE game_session_leaderboard_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "user_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE club (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE club_member (id INT NOT NULL, club_id INT NOT NULL, member_id INT NOT NULL, role VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_552B46F261190A32 ON club_member (club_id)');
        $this->addSql('CREATE INDEX IDX_552B46F27597D3FE ON club_member (member_id)');
        $this->addSql('CREATE TABLE game (id INT NOT NULL, session_id INT NOT NULL, started_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, state JSON DEFAULT NULL, status VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_232B318C613FECDF ON game (session_id)');
        $this->addSql('COMMENT ON COLUMN game.started_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE game_leaderboard (id INT NOT NULL, game_id INT NOT NULL, player_id INT NOT NULL, score INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_C67B1051E48FD905 ON game_leaderboard (game_id)');
        $this->addSql('CREATE INDEX IDX_C67B105199E6F5DF ON game_leaderboard (player_id)');
        $this->addSql('CREATE TABLE game_session (id INT NOT NULL, club_id INT NOT NULL, day DATE NOT NULL, iteration INT NOT NULL, status VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_4586AAFB61190A32 ON game_session (club_id)');
        $this->addSql('COMMENT ON COLUMN game_session.day IS \'(DC2Type:date_immutable)\'');
        $this->addSql('CREATE TABLE game_session_leaderboard (id INT NOT NULL, session_id INT NOT NULL, player_id INT NOT NULL, score INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_1F407775613FECDF ON game_session_leaderboard (session_id)');
        $this->addSql('CREATE INDEX IDX_1F40777599E6F5DF ON game_session_leaderboard (player_id)');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON "user" (email)');
        $this->addSql('ALTER TABLE club_member ADD CONSTRAINT FK_552B46F261190A32 FOREIGN KEY (club_id) REFERENCES club (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE club_member ADD CONSTRAINT FK_552B46F27597D3FE FOREIGN KEY (member_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318C613FECDF FOREIGN KEY (session_id) REFERENCES game_session (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE game_leaderboard ADD CONSTRAINT FK_C67B1051E48FD905 FOREIGN KEY (game_id) REFERENCES game (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE game_leaderboard ADD CONSTRAINT FK_C67B105199E6F5DF FOREIGN KEY (player_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE game_session ADD CONSTRAINT FK_4586AAFB61190A32 FOREIGN KEY (club_id) REFERENCES club (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE game_session_leaderboard ADD CONSTRAINT FK_1F407775613FECDF FOREIGN KEY (session_id) REFERENCES game_session (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE game_session_leaderboard ADD CONSTRAINT FK_1F40777599E6F5DF FOREIGN KEY (player_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE club_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE club_member_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE game_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE game_leaderboard_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE game_session_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE game_session_leaderboard_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE "user_id_seq" CASCADE');
        $this->addSql('ALTER TABLE club_member DROP CONSTRAINT FK_552B46F261190A32');
        $this->addSql('ALTER TABLE club_member DROP CONSTRAINT FK_552B46F27597D3FE');
        $this->addSql('ALTER TABLE game DROP CONSTRAINT FK_232B318C613FECDF');
        $this->addSql('ALTER TABLE game_leaderboard DROP CONSTRAINT FK_C67B1051E48FD905');
        $this->addSql('ALTER TABLE game_leaderboard DROP CONSTRAINT FK_C67B105199E6F5DF');
        $this->addSql('ALTER TABLE game_session DROP CONSTRAINT FK_4586AAFB61190A32');
        $this->addSql('ALTER TABLE game_session_leaderboard DROP CONSTRAINT FK_1F407775613FECDF');
        $this->addSql('ALTER TABLE game_session_leaderboard DROP CONSTRAINT FK_1F40777599E6F5DF');
        $this->addSql('DROP TABLE club');
        $this->addSql('DROP TABLE club_member');
        $this->addSql('DROP TABLE game');
        $this->addSql('DROP TABLE game_leaderboard');
        $this->addSql('DROP TABLE game_session');
        $this->addSql('DROP TABLE game_session_leaderboard');
        $this->addSql('DROP TABLE "user"');
    }
}
