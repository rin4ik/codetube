# Codetube

This is a youtube clone project by Codecourse.com.

## Installation

### Prerequisites

* To run this project, you must have PHP 7 installed.
* You should setup a host on your web server for your local domain. For this you could also configure Laravel Homestead or Valet. 

### Step 1

Begin by cloning this repository to your machine, and installing all Composer & NPM dependencies.

```bash
git clone git@github.com:rin4ik/codetube.git
cd codetube && composer install && npm install
npm run dev
```

### Step 2

Next, boot up a server and visit your forum. If using a tool like Laravel Valet, of course the URL will default to `http://codetube.test`. 

1. Visit: `http://codetube.test/register` to register a new codetube account.