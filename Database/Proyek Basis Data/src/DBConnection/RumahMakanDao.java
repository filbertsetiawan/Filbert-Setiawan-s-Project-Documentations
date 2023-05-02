package DBConnection;

import java.sql.*;
import java.util.ArrayList;
import java.util.Collection;
import java.util.Objects;
import java.util.Optional;
import java.util.logging.Level;
import java.util.logging.Logger;

public class RumahMakanDao implements Dao<RumahMakan, Integer> {
    private static final Logger LOGGER = Logger.getLogger(RumahMakanDao.class.getName());

    private final Optional<Connection> connection;
    private static JdbcConnection con;

    public RumahMakanDao() {
        this.connection = con.getConnection();
    }

    @Override
    public Optional<RumahMakan> get(int id_rumah_makan) {
        // Use the connection of the database
        return connection.flatMap(conn -> {
            Optional<RumahMakan> rumahMakan = Optional.empty();
            String sql = "SELECT * FROM rumahmakan WHERE id_rumah_makan = " + id_rumah_makan;

            // Create Statement to execute SQL
            try (Statement statement = conn.createStatement();
                 // ResultSet object is a table of data representing a database result set
                 ResultSet resultSet = statement.executeQuery(sql)) {

                if (resultSet.next()) {
                    String nama_rumah_makan = resultSet.getString("nama_rumah_makan");
                    String alamat_rumah_makan = resultSet.getString("alamat_rumah_makan");
                    String no_telp_rumah_makan = resultSet.getString("no_telp_rumah_makan");

                    rumahMakan = Optional.of(
                            new RumahMakan(id_rumah_makan, nama_rumah_makan, alamat_rumah_makan, no_telp_rumah_makan));

                    LOGGER.log(Level.INFO, "Found {0} in database", rumahMakan.get());
                }
            } catch (SQLException ex) {
                LOGGER.log(Level.SEVERE, null, ex);
            }
            return rumahMakan;
        });
    }

    @Override
    public Collection<RumahMakan> getAll() {
        Collection<RumahMakan> rumahMakans = new ArrayList<>();
        String sql = "SELECT * FROM rumahmakan ORDER BY id_rumah_makan";

        connection.ifPresent(conn -> {
            try (Statement statement = conn.createStatement();
                 ResultSet resultSet = statement.executeQuery(sql)) {

                while (resultSet.next()) {
                    int id_rumah_makan = resultSet.getInt("id_rumah_makan");
                    String nama_rumah_makan = resultSet.getString("nama_rumah_makan");
                    String alamat_rumah_makan = resultSet.getString("alamat_rumah_makan");
                    String no_telp_rumah_makan = resultSet.getString("no_telp_rumah_makan");

                    RumahMakan rumahMakan = new RumahMakan(id_rumah_makan, nama_rumah_makan, alamat_rumah_makan, no_telp_rumah_makan);

                    rumahMakans.add(rumahMakan);

                    LOGGER.log(Level.INFO, "Found {0} in database", rumahMakan);
                }

            } catch (SQLException ex) {
                LOGGER.log(Level.SEVERE, null, ex);
            }
        });
        return rumahMakans;
    }

    @Override
    public Optional<Integer> add(RumahMakan rumahMakan) {
        String message = "The rumahmakan to be added should not be null";
        RumahMakan nonNullRumahMakan = Objects.requireNonNull(rumahMakan, message);
        String sql = "INSERT INTO "
                + "rumahmakan(nama_rumah_makan, alamat_rumah_makan, no_telp_rumah_makan) "
                + "VALUES(?, ?, ?)";

        return connection.flatMap(conn -> {
            Optional<Integer> generatedId = Optional.empty();

            try (PreparedStatement statement =
                         conn.prepareStatement(
                                 sql,
                                 Statement.RETURN_GENERATED_KEYS)) {

                statement.setString(1, nonNullRumahMakan.getNama_rumah_makan());
                statement.setString(2, nonNullRumahMakan.getAlamat_rumah_makan());
                statement.setString(3, nonNullRumahMakan.getNo_telp_rumah_makan());

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
                        new Object[]{nonNullRumahMakan,
                                (numberOfInsertedRows > 0)});
            } catch (SQLException ex) {
                LOGGER.log(Level.SEVERE, null, ex);
            }
            return generatedId;
        });
    }

    @Override
    public void update(RumahMakan rumahMakan) {
        String message = "The rumahmakan to be updated should not be null";
        RumahMakan nonNullRumahMakan = Objects.requireNonNull(rumahMakan, message);
        String sql = "UPDATE rumahmakan "
                + "SET "
                + "nama_rumah_makan = ?, "
                + "alamat_rumah_makan = ?, "
                + "no_telp_rumah_makan = ? "
                + "WHERE "
                + "id_rumah_makan = ?";

        connection.ifPresent(conn -> {
            try (PreparedStatement statement = conn.prepareStatement(sql)) {

                statement.setString(1, nonNullRumahMakan.getNama_rumah_makan());
                statement.setString(2, nonNullRumahMakan.getAlamat_rumah_makan());
                statement.setString(3, nonNullRumahMakan.getNo_telp_rumah_makan());
                statement.setInt(4, nonNullRumahMakan.getId_rumah_makan());

                int numberOfUpdatedRows = statement.executeUpdate();

                LOGGER.log(Level.INFO, "Was the rumahmakan updated successfully? {0}",
                        numberOfUpdatedRows > 0);

            } catch (SQLException ex) {
                LOGGER.log(Level.SEVERE, null, ex);
            }
        });
    }

    @Override
    public void delete(int id_rumah_makan) {
        String sql = "DELETE FROM rumahmakan WHERE id_rumah_makan = ?";

        connection.ifPresent(conn -> {
            try (PreparedStatement statement = conn.prepareStatement(sql)) {

                statement.setInt(1, id_rumah_makan);

                int numberOfDeletedRows = statement.executeUpdate();

                LOGGER.log(Level.INFO, "Was the rumahmakan deleted successfully? {0}",
                        numberOfDeletedRows > 0);

            } catch (SQLException ex) {
                LOGGER.log(Level.SEVERE, null, ex);
            }
        });
    }
}
