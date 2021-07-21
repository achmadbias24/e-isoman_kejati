/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     09/07/2021 14:19:59                          */
/*==============================================================*/


/*==============================================================*/
/* Table: isoman                                                */
/*==============================================================*/
create table isoman
(
   ID_ISOMAN            int not null auto_increment comment '',
   NIP                  varchar(20)  comment '',
   MULAI_ISOMAN         date not null comment '',
   SELESAI_ISOMAN       date  comment '',
   FILE_PCR_POSITIF     varchar(255) not null comment '',
   FILE_PCR_NEGATIF     varchar(255)  comment '',
   KETERANGAN           varchar(21) not null  comment '',
   EMAIL_5_HARIAN       varchar(5)    comment '',
   EMAIL_10_HARIAN      varchar(5)    comment '',
   primary key (ID_ISOMAN)
);

/*==============================================================*/
/* Table: pegawai                                               */
/*==============================================================*/
create table pegawai
(
   NIP                  varchar(20) not null  comment '',
   NAMA_PEGAWAI         varchar(255)  comment '',
   PANGKAT              varchar(255)  comment '',
   JABATAN              varchar(255)  comment '',
   ALAMAT               varchar(255)  comment '',
   EMAIL                varchar(255)  comment '',
   primary key (NIP)
);

/*==============================================================*/
/* Table: ADMIN	                                               */
/*==============================================================*/
create table admin
(
   USERNAME		VARCHAR(20) not null comment '',
   NAMA			VARCHAR(255) comment '',
   PASSWORD		VARCHAR(255) comment '',
   primary key (USERNAME)
);
alter table isoman add constraint FK_isoman_RELATIONS_pegawai foreign key (NIP)
      references pegawai (NIP) on delete restrict on update restrict;

