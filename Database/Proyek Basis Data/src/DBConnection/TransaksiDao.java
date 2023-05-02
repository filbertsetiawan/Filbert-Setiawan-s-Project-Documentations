package DBConnection;

import sample.ControllerTransaksi;

import java.sql.*;
import java.util.ArrayList;
import java.util.Collection;
import java.util.Objects;
import java.util.Optional;
import java.util.logging.Level;
import java.util.logging.Logger;

public class TransaksiDao implements Dao<Transaksi, Integer> {
    private static final Logger LOGGER = Logger.getLogger(TransaksiDao.class.getName());

    private final Optional<Connection> connection;
    private static JdbcConnection con;

    public TransaksiDao() {
        this.connection = con.getConnection();
    }

    @Override
    public Optional<Transaksi> get(int kode_transaksi) {
        // Use the connection of the database
        return connection.flatMap(conn -> {
            Optional<Transaksi> transaksi = Optional.empty();
            String sql = "SELECT * FROM transaksi WHERE kode_transaksi = " + kode_transaksi;

            // Create Statement to execute SQL
            try (Statement statement = conn.createStatement();
                 // ResultSet object is a table of data representing a database result set
                 ResultSet resultSet = statement.executeQuery(sql)) {

                if (resultSet.next()) {
                    String nama_transaksi = resultSet.getString("nama_transaksi");
                    String tanggal_transaksi = resultSet.getString("tanggal_transaksi");
                    String metode_pembayaran = resultSet.getString("metode_pembayaran");
                    int jumlah_transaksi = resultSet.getInt("jumlah_transaksi");
                    int id_customer = resultSet.getInt("id_customer");
                    int id_rumah_makan = resultSet.getInt("id_rumah_makan");
                    int id_penyedia_barang = resultSet.getInt("id_penyedia_barang");

                    transaksi = Optional.of(
                            new Transaksi(kode_transaksi, nama_transaksi, tanggal_transaksi, metode_pembayaran, jumlah_transaksi, id_customer, id_rumah_makan, id_penyedia_barang));

                    LOGGER.log(Level.INFO, "Found {0} in database", transaksi.get());
                }
            } catch (SQLException ex) {
                LOGGER.log(Level.SEVERE, null, ex);
            }
            return transaksi;
        });
    }

    @Override
    public Collection<Transaksi> getAll() {
        Collection<Transaksi> transaksis = new ArrayList<>();
        String sql = "SELECT * FROM transaksi ORDER BY kode_transaksi";

        connection.ifPresent(conn -> {
            try (Statement statement = conn.createStatement();
                 ResultSet resultSet = statement.executeQuery(sql)) {

                while (resultSet.next()) {
                    int kode_transaksi = resultSet.getInt("kode_transaksi");
                    String nama_transaksi = resultSet.getString("nama_transaksi");
                    String tanggal_transaksi = resultSet.getString("tanggal_transaksi");
                    String metode_pembayaran = resultSet.getString("metode_pembayaran");
                    int jumlah_transaksi = resultSet.getInt("jumlah_transaksi");
                    int id_customer = resultSet.getInt("id_customer");
                    int id_rumah_makan = resultSet.getInt("id_rumah_makan");
                    int id_penyedia_barang = resultSet.getInt("id_penyedia_barang");

                    Transaksi transaksi = new Transaksi(kode_transaksi, nama_transaksi, tanggal_transaksi, metode_pembayaran, jumlah_transaksi, id_customer, id_rumah_makan, id_penyedia_barang);

                    transaksis.add(transaksi);

                    LOGGER.log(Level.INFO, "Found {0} in database", transaksi);
                }

            } catch (SQLException ex) {
                LOGGER.log(Level.SEVERE, null, ex);
            }
        });
        return transaksis;
    }

    @Override
    public Optional<Integer> add(Transaksi transaksi) {
        String message = "The transaksi to be added should not be null";
        Transaksi nonNullTransaksi = Objects.requireNonNull(transaksi, message);
        String sql = "INSERT INTO "
                + "transaksi(nama_transaksi, tanggal_transaksi, metode_pembayaran, jumlah_transaksi, id_customer, id_rumah_makan, id_penyedia_barang) "
                + "VALUES(?, to_date(?, 'yyyy-mm-dd'), ?, ?, ?, ?, ?)";
        return connection.flatMap(conn -> {
            Optional<Integer> generatedId = Optional.empty();

            if (ControllerTransaksi.pilih == 2) {
                try (PreparedStatement statement =
                             conn.prepareStatement(
                                     sql,
                                     Statement.RETURN_GENERATED_KEYS)) {

                    statement.setString(1, nonNullTransaksi.getNama_transaksi());
                    statement.setString(2, nonNullTransaksi.getTanggal_transaksi());
                    statement.setString(3, nonNullTransaksi.getMetode_pembayaran());
                    statement.setInt(4, nonNullTransaksi.getJumlah_transaksi());
                    statement.setInt(5, nonNullTransaksi.getId_customer());
                    statement.setInt(6, nonNullTransaksi.getId_rumah_makan());
                    statement.setNull(7, Types.INTEGER);

                    int numberOfInsertedRows = statement.executeUpdate();

                    // Retrieve the auto-generated id
                    if (numberOfInsertedRows > 0) {
                        try (ResultSet resultSet = statement.getGeneratedKeys()) {
                            if (resultSet.next()) {
                                generatedId = Optional.of(resultSet.getInt(1));
                            }
                        }
                    }

                    LOGGER.log(
                            Level.INFO,
                            "{0} created successfully? {1}",
                            new Object[]{nonNullTransaksi,
                                    (numberOfInsertedRows > 0)});
                } catch (SQLException ex) {
                    LOGGER.log(Level.SEVERE, null, ex);
                }
            } else if (ControllerTransaksi.pilih == 1) {
                try (PreparedStatement statement =
                             conn.prepareStatement(
                                     sql,
                                     Statement.RETURN_GENERATED_KEYS)) {

                    statement.setString(1, nonNullTransaksi.getNama_transaksi());
                    statement.setString(2, nonNullTransaksi.getTanggal_transaksi());
                    statement.setString(3, nonNullTransaksi.getMetode_pembayaran());
                    statement.setInt(4, nonNullTransaksi.getJumlah_transaksi());
                    statement.setInt(5, nonNullTransaksi.getId_customer());
                    statement.setNull(6, Types.INTEGER);
                    statement.setInt(7, nonNullTransaksi.getId_penyedia_barang());

                    int numberOfInsertedRows = statement.executeUpdate();

                    // Retrieve the auto-generated id
                    if (numberOfInsertedRows > 0) {
                        try (ResultSet resultSet = statement.getGeneratedKeys()) {
                            if (resultSet.next()) {
                                generatedId = Optional.of(resultSet.getInt(1));
                            }
                        }
                    }

                    LOGGER.log(
                            Level.INFO,
                            "{0} created successfully? {1}",
                            new Object[]{nonNullTransaksi,
                                    (numberOfInsertedRows > 0)});
                } catch (SQLException ex) {
                    LOGGER.log(Level.SEVERE, null, ex);
                }
            }
            return generatedId;
        });
    }

    @Override
    public void update(Transaksi transaksi) {
        String message = "The transaksi to be updated should not be null";
        Transaksi nonNullTransaksi = Objects.requireNonNull(transaksi, message);
        String sql = "UPDATE transaksi "
                + "SET "
                + "nama_transaksi = ?, "
                + "tanggal_transaksi = to_date(?, 'yyyy-mm-dd'), "
                + "metode_pembayaran = ?, "
                + "jumlah_transaksi = ?, "
                + "id_customer = ?, "
                + "id_rumah_makan = ?,"
                + "id_penyedia_barang = ?"
                + "WHERE "
                + "kode_transaksi = ?";

        connection.ifPresent(conn -> {
            if (ControllerTransaksi.pilih == 2) {
                try (PreparedStatement statement = conn.prepareStatement(sql)) {

                    statement.setString(1, nonNullTransaksi.getNama_transaksi());
                    statement.setString(2, nonNullTransaksi.getTanggal_transaksi());
                    statement.setString(3, nonNullTransaksi.getMetode_pembayaran());
                    statement.setInt(4, nonNullTransaksi.getJumlah_transaksi());
                    statement.setInt(5, nonNullTransaksi.getId_customer());
                    statement.setInt(6, nonNullTransaksi.getId_rumah_makan());
                    statement.setNull(7, Types.INTEGER);
                    statement.setInt(8, nonNullTransaksi.getKode_transaksi());

                    int numberOfUpdatedRows = statement.executeUpdate();

                    LOGGER.log(Level.INFO, "Was the transaksi updated successfully? {0}",
                            numberOfUpdatedRows > 0);

                } catch (SQLException ex) {
                    LOGGER.log(Level.SEVERE, null, ex);
                }
            } else if (ControllerTransaksi.pilih == 1) {
                try (PreparedStatement statement = conn.prepareStatement(sql)) {

                    statement.setString(1, nonNullTransaksi.getNama_transaksi());
                    statement.setString(2, nonNullTransaksi.getTanggal_transaksi());
                    statement.setString(3, nonNullTransaksi.getMetode_pembayaran());
                    statement.setInt(4, nonNullTransaksi.getJumlah_transaksi());
                    statement.setInt(5, nonNullTransaksi.getId_customer());
                    statement.setNull(6, Types.INTEGER);
                    statement.setInt(7, nonNullTransaksi.getId_penyedia_barang());
                    statement.setInt(8, nonNullTransaksi.getKode_transaksi());

                    int numberOfUpdatedRows = statement.executeUpdate();

                    LOGGER.log(Level.INFO, "Was the transaksi updated successfully? {0}",
                            numberOfUpdatedRows > 0);

                } catch (SQLException ex) {
                    LOGGER.log(Level.SEVERE, null, ex);
                }
            }
        });
    }

    @Override
    public void delete(int kode_transaksi) {
        String sql = "DELETE FROM transaksi WHERE kode_transaksi = ?";

        connection.ifPresent(conn -> {
            try (PreparedStatement statement = conn.prepareStatement(sql)) {

                statement.setInt(1, kode_transaksi);

                int numberOfDeletedRows = statement.executeUpdate();

                LOGGER.log(Level.INFO, "Was the transaksi deleted successfully? {0}",
                        numberOfDeletedRows > 0);

            } catch (SQLException ex) {
                LOGGER.log(Level.SEVERE, null, ex);
            }
        });
    }
}
