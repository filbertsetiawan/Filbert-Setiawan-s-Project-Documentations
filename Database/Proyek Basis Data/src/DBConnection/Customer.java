package DBConnection;

public class Customer {
    int id_customer;
    String nama_customer;
    String alamat_customer;
    String no_telp_customer;

    public Customer (int id_customer, String nama_customer, String alamat_customer, String no_telp_customer) {
        this.id_customer = id_customer;
        this.nama_customer = nama_customer;
        this.alamat_customer = alamat_customer;
        this.no_telp_customer = no_telp_customer;
    }

    public Integer getId_customer() {
        return id_customer;
    }

    public void setId_customer(Integer id_customer) {
        this.id_customer = id_customer;
    }

    public String getNama_customer() {
        return nama_customer;
    }

    public void setNama_customer(String nama_customer) {
        this.nama_customer = nama_customer;
    }

    public String getAlamat_customer() {
        return alamat_customer;
    }

    public void setAlamat_customer(String alamat_customer) {
        this.alamat_customer = alamat_customer;
    }

    public String getNo_telp_customer() {
        return no_telp_customer;
    }

    public void setNo_telp_customer(String no_telp_customer) {
        this.no_telp_customer = no_telp_customer;
    }
}
