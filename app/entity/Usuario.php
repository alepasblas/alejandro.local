<?php
namespace alejandro\app\entity;

use alejandro\core\database\IEntity;
class Usuario implements IEntity {
    private int $id;
    private string $username;
    private string $password;
    private string $role;

    // Constructor
    public function __construct(string $username="", string $password="", string $role="") {
        $this->username = $username;
        $this->password = $password;
        $this->role = $role;
    }

    // Getters
    public function getId(): ?int {
        return $this->id;
    }

    public function getUsername(): string {
        return $this->username;
    }

    public function getPassword(): string {
        return $this->password;
    }

    public function getRole(): string {
        return $this->role;
    }

    // Setters (except setId)
    public function setUsername(string $username): void {
        $this->username = $username;
    }

    public function setPassword(string $password): void {
        $this->password = $password;
    }

    public function setRole(string $role): void {
        $this->role = $role;
    }

    public function toArray(): array {
        return [
            'username' => $this->username,
            'password' => $this->password,
            'role' => $this->role,
        ];
    }
}
?>