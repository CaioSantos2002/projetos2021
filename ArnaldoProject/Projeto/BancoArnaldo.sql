drop database if exists arnaldo;
create database arnaldo;
use arnaldo;

create table Produtos(
    cod integer primary key auto_increment not null,
    nome varchar(40) not null,
    descricao varchar(200) not null,
    valor decimal(6,2) not null,
    quantidade integer not null
);

create table Compras(
    cod integer auto_increment not null,
    data timestamp not null,
    codProduto integer not null,
    custo decimal(6,2) not null,
    quantidade integer not null,
    primary key (cod),
    constraint fk_cod_prod foreign key (codProduto)
	references Produtos(cod)
);

create table Vendas(
    cod integer auto_increment not null,
    codProduto integer not null,
    preco decimal(6,2) not null,
    quantidade integer not null,
    primary key(cod),
    constraint fk_cod_vendas 
    foreign key (codProduto)
    references Produtos(cod)
);

describe Produtos;
describe Compras;
describe Vendas;
show tables;

insert into Produtos
values
    (default, "Camiseta", "Camiseta Preta ", 15, 300),
    (default, "Camiseta", "Camiseta Branca", 10, 250),
    (default, "Mochila", "Mochila Ben 10", 60, 500),
    (default, "Bermuda", "Bermuda Quiksilver", 30, 300),
    (default, "Relogio", "Relogio Cassio", 25, 120),
    (default, "Caneta", "Caneta Bic", 0.25, 800),
    (default, "Vassoura", "Vassoura de pobre", 5, 260);



insert into Compras values (default,NOW(),1, (select valor from Produtos where cod = 1) ,10);
insert into Compras values (default,NOW(),2, (select valor from Produtos where cod = 2) ,10);
insert into Compras values (default,NOW(),3, (select valor from Produtos where cod = 3) ,2);
insert into Compras values (default,NOW(),4, (select valor from Produtos where cod = 4) ,10);
insert into Compras values (default,NOW(),5, (select valor from Produtos where cod = 5) ,5);
insert into Compras values (default,NOW(),6, (select valor from Produtos where cod = 6) ,100);
insert into Compras values (default,NOW(),7, (select valor from Produtos where cod = 7) ,20);

Select * from Compras;

insert into Vendas values (default,1, (select 2*custo from Compras where cod = 1) ,10);
insert into Vendas values (default,2, (select 2*custo from Compras where cod = 2) ,5);
insert into Vendas values (default,3, (select 2*custo from Compras where cod = 3) ,1);
insert into Vendas values (default,4, (select 2*custo from Compras where cod = 4) ,8);
insert into Vendas values (default,5, (select 2*custo from Compras where cod = 5) ,3);
insert into Vendas values (default,6, (select 2*custo from Compras where cod = 6) ,25);
insert into Vendas values (default,7, (select 2*custo from Compras where cod = 7) ,12);

Select * from Vendas;
