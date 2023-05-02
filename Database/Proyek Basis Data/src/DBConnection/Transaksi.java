package DBConnection;

public class Transaksi {
    Integer kode_transaksi;
    String nama_transaksi;
    String tanggal_transaksi;
    String metode_pembayaran;
    Integer jumlah_transaksi;
    Integer id_customer;
    Integer id_rumah_makan;
    Integer id_penyedia_barang;

    public Transaksi(Integer kode_transaksi, String nama_transaksi, String tanggal_transaksi, String metode_pembayaran, Integer jumlah_transaksi, Integer id_customer, Integer id_rumah_makan, Integer id_penyedia_barang) {
        this.kode_transaksi = kode_transaksi;
        this.nama_transaksi = nama_transaksi;
        this.tanggal_transaksi = tanggal_transaksi;
        this.metode_pembayaran = metode_pembayaran;
        this.jumlah_transaksi = jumlah_transaksi;
        this.id_customer = id_customer;
        this.id_rumah_makan = id_rumah_makan;
        this.id_penyedia_barang = id_penyedia_barang;
    }

    public Integer getKode_transaksi() {
        return kode_transaksi;
    }

    public void setKode_transaksi(Integer kode_transaksi) {
        this.kode_transaksi = kode_transaksi;
    }

    public String getNama_transaksi() {
        return nama_transaksi;
    }

    public void setNama_transaksi(String nama_transaksi) {
        this.nama_transaksi = nama_transaksi;
    }

    public String getTanggal_transaksi() {
        return tanggal_transaksi;
    }

    public void setTanggal_transaksi(String tanggal_transaksi) {
        this.tanggal_transaksi = tanggal_transaksi;
    }

    public String getMetode_pembayaran() {
        return metode_pembayaran;
    }

    public void setMetode_pembayaran(String metode_pembayaran) {
        this.metode_pembayaran = metode_pembayaran;
    }

    public Integer getJumlah_transaksi() {
        return jumlah_transaksi;
    }

    public void setJumlah_transaksi(Integer jumlah_transaksi) {
        this.jumlah_transaksi = jumlah_transaksi;
    }

    public Integer getId_customer() {
        return id_customer;
    }

    public void setId_customer(Integer id_customer) {
        this.id_customer = id_customer;
    }

    public Integer getId_rumah_makan() {
        return id_rumah_makan;
    }

    public void setId_rumah_makan(Integer id_rumah_makan) {
        this.id_rumah_makan = id_rumah_makan;
    }

    public Integer getId_penyedia_barang() {
        return id_penyedia_barang;
    }

    public void setId_penyedia_barang(Integer id_penyedia_barang) {
        this.id_penyedia_barang = id_penyedia_barang;
    }
}
