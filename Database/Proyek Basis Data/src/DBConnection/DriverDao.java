package DBConnection;

import java.sql.*;
import java.util.ArrayList;
import java.util.Collection;
import java.util.Objects;
import java.util.Optional;
import java.util.logging.Level;
import java.util.logging.Logger;

public class DriverDao implements Dao<Driver, Integer> {
    private static final Logger LOGGER = Logger.getLogger(CustomerDao.class.getName());

    private final Optional<Connection> connection;
    private static JdbcConnection con;

    public DriverDao() {
        this.connection = con.getConnection();
    }

    @Override
    public Optional<Driver> get(int id_driver) {
        // Use the connection of the database
        return connection.flatMap(conn -> {
            Optional<Driver> driver = Optional.empty();
            String sql = "SELECT * FROM driver WHERE id_driver = " + id_driver;

            // Create Statement to execute SQL
            try (Statement statement = conn.createStatement();
                 // ResultSet object is a table of data representing a database result set
                 ResultSet resultSet = statement.executeQuery(sql)) {

                if (resultSet.next()) {
                    String nama_driver = resultSet.getString("nama_driver");
                    String plat_nomor_driver = resultSet.getString("plat_nomor_driver");

                    driver = Optional.of(
                            new Driver(id_driver, nama_driver, plat_nomor_driver));

                    LOGGER.log(Level.INFO, "Found {0} in database", driver.get());
                }
            } catch (SQLException ex) {
                LOGGER.log(Level.SEVERE, null, ex);
            }
            return driver;
        });
    }

    @Override
    public Collection<Driver> getAll() {
        Collection<Driver> drivers = new ArrayList<>();
        String sql = "SELECT * FROM driver ORDER BY id_driver";

        connection.ifPresent(conn -> {
            try (Statement statement = conn.createStatement();
                 ResultSet resultSet = statement.executeQuery(sql)) {

                while (resultSet.next()) {
                    int id_driver = resultSet.getInt("id_driver");
                    String nama_driver = resultSet.getString("nama_driver");
                    String plat_nomor_driver = resultSet.getString("plat_nomor_driver");

                    Driver driver = new Driver(id_driver, nama_driver, plat_nomor_driver);

                    drivers.add(driver);

                    LOGGER.log(Level.INFO, "Found {0} in database", driver);
                }

            } catch (SQLException ex) {
                LOGGER.log(Level.SEVERE, null, ex);
            }
        });
        return drivers;
    }

    @Override
    public Optional<Integer> add(Driver driver) {
        String message = "The driver to be added should not be null";
        Driver nonNullDriver = Objects.requireNonNull(driver, message);
        String sql = "INSERT INTO "
                + "driver(nama_driver, plat_nomor_driver) "
                + "VALUES(?, ?)";

        return connection.flatMap(conn -> {
            Optional<Integer> generatedId = Optional.empty();

            try (PreparedStatement statement =
                         conn.prepareStatement(
                                 sql,
                                 Statement.RETURN_GENERATED_KEYS)) {

                statement.setString(1, nonNullDriver.getNama_driver());
                statement.setString(2, nonNullDriver.getPlat_nomor_driver());

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
                        new Object[]{nonNullDriver,
                                (numberOfInsertedRows > 0)});
            } catch (SQLException ex) {
                LOGGER.log(Level.SEVERE, null, ex);
            }
            return generatedId;
        });
    }

    @Override
    public void update(Driver driver) {
        String message = "The driver to be updated should not be null";
        Driver nonNullDriver = Objects.requireNonNull(driver, message);
        String sql = "UPDATE driver "
                + "SET "
                + "nama_driver = ?, "
                + "plat_nomor_driver = ? "
                + "WHERE "
                + "id_driver = ?";

        connection.ifPresent(conn -> {
            try (PreparedStatement statement = conn.prepareStatement(sql)) {

                statement.setString(1, nonNullDriver.getNama_driver());
                statement.setString(2, nonNullDriver.getPlat_nomor_driver());
                statement.setInt(3, nonNullDriver.getId_driver());

                int numberOfUpdatedRows = statement.executeUpdate();

                LOGGER.log(Level.INFO, "Was the driver updated successfully? {0}",
                        numberOfUpdatedRows > 0);

            } catch (SQLException ex) {
                LOGGER.log(Level.SEVERE, null, ex);
            }
        });
    }

    @Override
    public void delete(int id_driver) {
        String sql = "DELETE FROM driver WHERE id_driver = ?";

        connection.ifPresent(conn -> {
            try (PreparedStatement statement = conn.prepareStatement(sql)) {

                statement.setInt(1, id_driver);

                int numberOfDeletedRows = statement.executeUpdate();

                LOGGER.log(Level.INFO, "Was the driver deleted successfully? {0}",
                        numberOfDeletedRows > 0);

            } catch (SQLException ex) {
                LOGGER.log(Level.SEVERE, null, ex);
            }
        });
    }
}
