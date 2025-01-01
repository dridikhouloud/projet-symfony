<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderRepository::class)]
#[ORM\Table(name: '`order`')]
class Order
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $order_date = null;

    #[ORM\Column(length: 255)]
    private ?string $status = null;

    #[ORM\Column]
    private ?float $table_mount = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOrderDate(): ?string
    {
        return $this->order_date;
    }

    public function setOrderDate(string $order_date): static
    {
        $this->order_date = $order_date;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getTableMount(): ?float
    {
        return $this->table_mount;
    }

    public function setTableMount(float $table_mount): static
    {
        $this->table_mount = $table_mount;

        return $this;
    }
}
