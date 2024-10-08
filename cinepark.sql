


CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(255) NOT NULL,
    last_name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE events (
    event_id INT PRIMARY KEY AUTO_INCREMENT,
    event_name VARCHAR(50) NOT NULL,
    event_date DATE,
    location VARCHAR(255) NOT NULL,
    category VARCHAR(255) NOT NULL,
    image_url VARCHAR(255) NOT NULL,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

INSERT INTO events (event_name, event_date, location, category, image_url, description)
VALUES
    ('Anniv Party', '2023-11-15', 'Liberty State Park Jersey City, NJ', 'Anniversary','../images/event_1.jpeg', 'Celebrate our love'),
    ('Bridal Bash', '2023-11-20', 'Lenape Park Cranford, NJ', 'Bridal Shower','../images/event_2.jpeg', 'Showering love on the bride-to-be'),
    ('Just Because', '2023-11-25', 'Hoboken Pier A Park Hoboken, NJ', 'Just because','../images/event_3.png', 'Because every moment is special'),
    ('B-Day Bash', '2023-11-30', 'Brookdale Park, Bloomfield NJ', 'Birthday','../images/event_4.jpeg', 'Cheers to another year of life'),
    ('Baby Shower', '2023-12-05', 'Private Residence', 'Baby Shower', '../images/event_5.jpeg','Welcoming the newest member'),
    ('Gender Reveal', '2023-12-10', 'Other Location', 'Gender Reveal','../images/event_6.jpeg', 'Discovering our baby gender'),
    ('Proposal Day', '2023-12-15', 'Liberty State Park Jersey City, NJ', 'Proposal','../images/event_7.jpeg','She said yes!'),
    ('Intimate Wedding', '2023-12-20', 'Hoboken Pier A Park Hoboken, NJ', 'Intimate Wedding', '../images/event_8.jpeg','Tying the knot with our closest'),
    ('Special Event', '2023-12-25', 'Lenape Park Cranford, NJ', 'Other', '../images/event_9.jpeg','A special gathering for joy');

CREATE TABLE bookings (
    booking_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    user_email VARCHAR(255),
    package_name VARCHAR(255) NOT NULL,
    guest_count INT,
    color_palette VARCHAR(50),
    addons TEXT,
    event_date DATE,
    time_slot VARCHAR(20),
    location VARCHAR(255),
    occasion VARCHAR(255),
    full_name VARCHAR(255) NOT NULL,
    phone_number VARCHAR(15) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


ALTER TABLE bookings
ADD COLUMN movie_name VARCHAR(255),
ADD COLUMN genre_option VARCHAR(50);

-- Table for User Reviews
CREATE TABLE IF NOT EXISTS user_reviews (
    review_id INT PRIMARY KEY AUTO_INCREMENT,
    event_id INT,
    user_id INT,
    rating INT,
    review_text TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (event_id) REFERENCES events(event_id),
    FOREIGN KEY (user_id) REFERENCES users(id)
);

-- Table for Event Inventory
CREATE TABLE IF NOT EXISTS event_inventory (
    item_id INT PRIMARY KEY AUTO_INCREMENT,
    event_id INT,
    item_name VARCHAR(255) NOT NULL,
    quantity INT,
    price DECIMAL(10, 2) NOT NULL,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (event_id) REFERENCES events(event_id)
);
