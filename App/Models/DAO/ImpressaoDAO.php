<?php

namespace App\Models\DAO;

use App\Abstractions\DAO;

class ImpressaoDAO extends DAO
{
    public function getFiliais(): ?array
    {
        $sql = $this->getSqlFiliais();

        $resultado = $this->selectWithBindValue($sql);

        if (!$resultado) {
            return null;
        }

        return $resultado;
    }
    
    public function getPromocoes(int $idFilial): ?array
    {
        $sql = $this->getSqlPromocoes();

        $parametros = ['idFilial' => $idFilial];

        $resultado = $this->selectWithBindValue($sql, $parametros);

        if (!$resultado) {
            return null;
        }

        return $resultado;
    }

    public function getCategorias(): ?array
    {
        $sql = $this->getSqlCategorias();

        $resultado = $this->selectWithBindValue($sql);

        if (!$resultado) {
            return null;
        }

        return $resultado;
    }

    public function getSubcategorias(): ?array
    {
        $sql = $this->getSqlSubcategorias();

        $resultado = $this->selectWithBindValue($sql);

        if (!$resultado) {
            return null;
        }

        return $resultado;
    }

    public function getIdProdutos(): ?array
    {
        $sql = $this->getSqlIdprodutos();

        $resultado = $this->selectWithBindValue($sql);

        if (!$resultado) {
            return null;
        }

        return $resultado;
    }

    private function getSqlFiliais(): string
    {
        return "SELECT
                id_empresa,
                id_filial,
                numero_filial,
                cidade
            FROM
                usuario
            GROUP BY
                id_empresa,
                id_filial,
                numero_filial,
                cidade
            ORDER BY
                id_empresa,
                id_filial";
    }

    private function getSqlPromocoes(): string
    {
        return "SELECT
                p.id as id_promocao
                ,p.descricao
                ,t.descricao as tipo
            FROM promocao p
            left join tipo_pagamento t on p.id_tipo_pagamento = t.id
            WHERE
                id_filial = :idFilial
            GROUP BY
            descricao";
    }

    private function getSqlCategorias(): string
    {
        return "SELECT
                id_departamento,
                departamento
            FROM
                produto
            GROUP BY
                id_departamento,
                departamento";
    }

    private function getSqlSubcategorias(): string
    {
        return "SELECT
                id_sub_departamento,
                sub_departamento
            FROM
                produto
            GROUP BY
                id_sub_departamento,
                sub_departamento";
    }

    private function getSqlIdProdutos(): string
    {
        return "SELECT
                    id_produto
                    ,produto
                FROM produtonew
                GROUP BY
                    id_produto";
    }
}
