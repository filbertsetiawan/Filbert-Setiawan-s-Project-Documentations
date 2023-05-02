package DBConnection;

import java.sql.*;
import java.util.ArrayList;
import java.util.Collection;
import java.util.Objects;
import java.util.Optional;
import java.util.logging.Level;
import java.util.logging.Logger;

public class PenyediaBarangDao implements Dao<PenyediaBarang, Integer> {
    private static final Logger LOGGER = Logger.getLogger(CustomerDao.class.getName());

    private final Optional<Connection> connection;
    private static JdbcConnection con;

    public PenyediaBarangDao() {
        this.connection = con.getConnection();
    }

    @Override
    public Optional<PenyediaBarang> get(int id_penyedia_barang) {
        // Use the connection of the database
        return connection.flatMap(conn -> {
            Optional<PenyediaBarang> penyediaBarang = Optional.empty();
            String sql = "SELECT * FROM penyediabarang WHERE id_penyedia_barang = " + id_penyedia_barang;

            // Create Statement to execute SQL
            try (Statement statement = conn.createStatement();
                 // ResultSet object is a table of data representing a database result set
                 ResultSet resultSet = statement.executeQuery(sql)) {

                if (resultSet.next()) {
                    String nama_penyedia_barang = resultSet.getString("nama_penyedia_barang");
                    String alamat_penyedia_barang = resultSet.getString("alamat_penyedia_barang");
                    String no_telp_penyedia_barang = resultSet.getString("no_telp_penyedia_barang");

                    penyediaBarang = Optional.of(
                            new PenyediaBarang(id_penyedia_barang, nama_penyedia_barang, alamat_penyedia_barang, no_telp_penyedia_barang));

                    LOGGER.log(Level.INFO, "Found {0} in database", penyediaBarang.get());
                }
            } catch (SQLException ex) {
                LOGGER.log(Level.SEVERE, null, ex);
            }
            return penyediaBarang;
        });
    }

    @Override
    public Collection<PenyediaBarang> getAll() {
        Collection<PenyediaBarang> penyediaBarangs = new ArrayList<>();
        String sql = "SELECT * FROM penyediabarang ORDER BY id_penyedia_barang";

        connection.ifPresent(conn -> {
            try (Statement statement = conn.createStatement();
                 ResultSet resultSet = statement.executeQuery(sql)) {

                while (resultSet.next()) {
                    int id_penyedia_barang = resultSet.getInt("id_penyedia_barang");
                    String nama_penyedia_barang = resultSet.getString("nama_penyedia_barang");
                    String alamat_penyedia_barang = resultSet.getString("alamat_penyedia_barang");
                    String no_telp_penyedia_barang = resultSet.getString("no_telp_penyedia_barang");

                    PenyediaBarang penyediaBarang = new PenyediaBarang(id_penyedia_barang, nama_penyedia_barang, alamat_penyedia_barang, no_telp_penyedia_barang);

                    penyediaBarangs.add(penyediaBarang);

                    LOGGER.log(Level.INFO, "Found {0} in database", penyediaBarang);
                }

            } catch (SQLException ex) {
                LOGGER.log(Level.SEVERE, null, ex);
            }
        });
        return penyediaBarangs;    }

    @Override
    public Optional<Integer> add(PenyediaBarang penyediaBarang) {
        String message = "The penyediabarang to be added should not be null";
        PenyediaBarang nonNullPenyediaBarang = Objects.requireNonNull(penyediaBarang, message);
        String sql = "INSERT INTO "
                + "penyediabarang(nama_penyedia_barang, alamat_penyedia_barang, no_telp_penyedia_barang) "
                + "VALUES(?, ?, ?)";

        return connection.flatMap(conn -> {
            Optional<Integer> generatedId = Optional.empty();

            try (PreparedStatement statement =
                         conn.prepareStatement(
                                 sql,
                                 Statement.RETURN_GENERATED_KEYS)) {

                statement.setString(1, nonNullPenyediaBarang.getNama_penyedia_barang());
                statement.setString(2, nonNullPenyediaBarang.getAlamat_penyedia_barang());
                statement.setString(3, nonNullPenyediaBarang.getNo_telp_penyedia_barang());

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
                        new Object[]{nonNullPenyediaBarang,
                                (numberOfInsertedRows > 0)});
            } catch (SQLException ex) {
                LOGGER.log(Level.SEVERE, null, ex);
            }
            return generatedId;
        });    }

    @Override
    public void update(PenyediaBarang penyediaBarang) {
        String message = "The penyediabarang to be updated should not be null";
        PenyediaBarang nonNullPenyediaBarang = Objects.requireNonNull(penyediaBarang, message);
        String sql = "UPDATE penyediabarang "
                + "SET "
                + "nama_penyedia_barang = ?, "
                + "alamat_penyedia_barang = ?, "
                + "no_telp_penyedia_barang = ? "
                + "WHERE "
                + "id_penyedia_barang = ?";

        connection.ifPresent(conn -> {
            try (PreparedStatement statement = conn.prepareStatement(sql)) {

                statement.setString(1, nonNullPenyediaBarang.getNama_penyedia_barang());
                statement.setString(2, nonNullPenyediaBarang.getAlamat_penyedia_barang());
                statement.setString(3, nonNullPenyediaBarang.getNo_telp_penyedia_barang());
                statement.setInt(4, nonNullPenyediaBarang.getId_penyedia_barang());

                int numberOfUpdatedRows = statement.executeUpdate();

                LOGGER.log(Level.INFO, "Was the penyediabarang updated successfully? {0}",
                        numberOfUpdatedRows > 0);

            } catch (SQLException ex) {
                LOGGER.log(Level.SEVERE, null, ex);
            }
        });
    }

    @Override
    public void delete(int id_penyedia_barang) {
        String sql = "DELETE FROM penyediabarang WHERE id_penyedia_barang = ?";

        connection.ifPresent(conn -> {
            try (PreparedStatement statement = conn.prepareStatement(sql)) {

                statement.setInt(1, id_penyedia_barang);

                int numberOfDeletedRows = statement.executeUpdate();

                LOGGER.log(Level.INFO, "Was the penyediabarang deleted successfully? {0}",
                        numberOfDeletedRows > 0);

            } catch (SQLException ex) {
                LOGGER.log(Level.SEVERE, null, ex);
            }
        });
    }
}
