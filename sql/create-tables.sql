create table if not exists bids (
      id           bigint       primary key
    , code         varchar(255)
    , title        bigint
    , bid_delivery varchar(255)
);

create table if not exists bid_deliveries (
      id   bigint       primary key
    , code varchar(255)
);
