package DBConnection;

public class RumahMakan {
    int id_rumah_makan;
    String nama_rumah_makan;
    String alamat_rumah_makan;
    String no_telp_rumah_makan;

    public RumahMakan(int id_rumah_makan, String nama_rumah_makan, String alamat_rumah_makan, String no_telp_rumah_makan) {
        this.id_rumah_makan = id_rumah_makan;
        this.nama_rumah_makan = nama_rumah_makan;
        this.alamat_rumah_makan = alamat_rumah_makan;
        this.no_telp_rumah_makan = no_telp_rumah_makan;
    }

    public int getId_rumah_makan() {
        return id_rumah_makan;
    }

    public void setId_rumah_makan(int id_rumah_makan) {
        this.id_rumah_makan = id_rumah_makan;
    }

    public String getNama_rumah_makan() {
        return nama_rumah_makan;
    }

    public void setNama_rumah_makan(String nama_rumah_makan) {
        this.nama_rumah_makan = nama_rumah_makan;
    }

    public String getAlamat_rumah_makan() {
        return alamat_rumah_makan;
    }

    public void setAlamat_rumah_makan(String alamat_rumah_makan) {
        this.alamat_rumah_makan = alamat_rumah_makan;
    }

    public String getNo_telp_rumah_makan() {
        return no_telp_rumah_makan;
    }

    public void setNo_telp_rumah_makan(String no_telp_rumah_makan) {
        this.no_telp_rumah_makan = no_telp_rumah_makan;
    }
}
