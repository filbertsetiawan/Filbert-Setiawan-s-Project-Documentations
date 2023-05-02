package DBConnection;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.SQLException;
import java.util.Optional;
import java.util.logging.Level;
import java.util.logging.Logger;

public class JdbcConnection {
    private static final Logger LOGGER =
            Logger.getLogger(JdbcConnection.class.getName());
    private static Optional<Connection> connection = Optional.empty();
    public static Optional<Connection> getConnection() {
        if (connection.isEmpty()) {
            //Jenis Database yang digunakan
            String dbType = "jdbc:postgresql:";
            //URL database
            String dbUrl = "//localhost:";
            //Port
            String dbPort = "5432/";
            //Nama database yang digunakan
            String dbName = "Proyek";
            //Nama user database
            String dbUser = "postgres";
            //Password
            String dbPass = "Nfilberts11";

            try {
                connection = Optional.ofNullable(
                        DriverManager.getConnection(
                                dbType+dbUrl+dbPort+dbName, dbUser, dbPass
                        )
                );
                if (connection != null) {
                    System.out.println("Connection OK!");
                } else {
                    System.out.println("Connection Failed!");
                }
            } catch (SQLException e) {
                LOGGER.log(Level.SEVERE,null, e);
            }
        }
        return connection;
    }
}
