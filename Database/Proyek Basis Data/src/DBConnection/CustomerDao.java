package DBConnection;

import java.sql.*;
import java.util.ArrayList;
import java.util.Collection;
import java.util.Objects;
import java.util.Optional;
import java.util.logging.Level;
import java.util.logging.Logger;

public class CustomerDao implements Dao<Customer, Integer> {
    private static final Logger LOGGER = Logger.getLogger(CustomerDao.class.getName());

    private final Optional<Connection> connection;
    private static JdbcConnection con;

    public CustomerDao() {
        this.connection = con.getConnection();
    }

    @Override
    public Optional<Customer> get(int id_customer) {
        // Use the connection of the database
        return connection.flatMap(conn -> {
            Optional<Customer> customer = Optional.empty();
            String sql = "SELECT * FROM customer WHERE id_customer = " + id_customer;

            // Create Statement to execute SQL
            try (Statement statement = conn.createStatement();
                 // ResultSet object is a table of data representing a database result set
                 ResultSet resultSet = statement.executeQuery(sql)) {

                if (resultSet.next()) {
                    String nama_customer = resultSet.getString("nama_customer");
                    String alamat_customer = resultSet.getString("alamat_customer");
                    String no_telp_customer = resultSet.getString("no_telp_customer");

                    customer = Optional.of(
                            new Customer(id_customer, nama_customer, alamat_customer, no_telp_customer));

                    LOGGER.log(Level.INFO, "Found {0} in database", customer.get());
                }
            } catch (SQLException ex) {
                LOGGER.log(Level.SEVERE, null, ex);
            }
            return customer;
        });
    }

    @Override
    public Collection<Customer> getAll() {
        Collection<Customer> customers = new ArrayList<>();
        String sql = "SELECT * FROM customer ORDER BY id_customer";

        connection.ifPresent(conn -> {
            try (Statement statement = conn.createStatement();
                 ResultSet resultSet = statement.executeQuery(sql)) {

                while (resultSet.next()) {
                    int id_customer = resultSet.getInt("id_customer");
                    String nama_customer = resultSet.getString("nama_customer");
                    String alamat_customer = resultSet.getString("alamat_customer");
                    String no_telp_customer = resultSet.getString("no_telp_customer");

                    Customer customer = new Customer(id_customer, nama_customer, alamat_customer, no_telp_customer);

                    customers.add(customer);

                    LOGGER.log(Level.INFO, "Found {0} in database", customer);
                }

            } catch (SQLException ex) {
                LOGGER.log(Level.SEVERE, null, ex);
            }
        });
        return customers;
    }

    @Override
    public Optional<Integer> add(Customer customer) {
        String message = "The customer to be added should not be null";
        Customer nonNullCustomer = Objects.requireNonNull(customer, message);
        String sql = "INSERT INTO "
                + "customer(nama_customer, alamat_customer, no_telp_customer) "
                + "VALUES(?, ?, ?)";

        return connection.flatMap(conn -> {
            Optional<Integer> generatedId = Optional.empty();

            try (PreparedStatement statement =
                         conn.prepareStatement(
                                 sql,
                                 Statement.RETURN_GENERATED_KEYS)) {

                statement.setString(1, nonNullCustomer.getNama_customer());
                statement.setString(2, nonNullCustomer.getAlamat_customer());
                statement.setString(3, nonNullCustomer.getNo_telp_customer());

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
                        new Object[]{nonNullCustomer,
                                (numberOfInsertedRows > 0)});
            } catch (SQLException ex) {
                LOGGER.log(Level.SEVERE, null, ex);
            }
            return generatedId;
        });
    }

    @Override
    public void update(Customer customer) {
        String message = "The customer to be updated should not be null";
        Customer nonNullCustomer = Objects.requireNonNull(customer, message);
        String sql = "UPDATE customer "
                + "SET "
                + "nama_customer = ?, "
                + "alamat_customer = ?, "
                + "no_telp_customer = ? "
                + "WHERE "
                + "id_customer = ?";

        connection.ifPresent(conn -> {
            try (PreparedStatement statement = conn.prepareStatement(sql)) {

                statement.setString(1, nonNullCustomer.getNama_customer());
                statement.setString(2, nonNullCustomer.getAlamat_customer());
                statement.setString(3, nonNullCustomer.getNo_telp_customer());
                statement.setInt(4, nonNullCustomer.getId_customer());

                int numberOfUpdatedRows = statement.executeUpdate();

                LOGGER.log(Level.INFO, "Was the customer updated successfully? {0}",
                        numberOfUpdatedRows > 0);

            } catch (SQLException ex) {
                LOGGER.log(Level.SEVERE, null, ex);
            }
        });
    }

    @Override
    public void delete(int id_customer) {
        String sql = "DELETE FROM customer WHERE id_customer = ?";

        connection.ifPresent(conn -> {
            try (PreparedStatement statement = conn.prepareStatement(sql)) {

                statement.setInt(1, id_customer);

                int numberOfDeletedRows = statement.executeUpdate();

                LOGGER.log(Level.INFO, "Was the customer deleted successfully? {0}",
                        numberOfDeletedRows > 0);

            } catch (SQLException ex) {
                LOGGER.log(Level.SEVERE, null, ex);
            }
        });
    }
}
