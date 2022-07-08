# pw based

`ssh-copy-id -o PubkeyAuthentication=no -i ~/.ssh/ionos.pub root@82.165.21.202`

# SSH

* SSH Schlüssel auf einem
  Client [generiern](https://www.thomas-krenn.com/de/wiki/OpenSSH_Public_Key_Authentifizierung_unter_Ubuntu):

      ssh-keygen -t rsa -b 4096 -f ~/.ssh/ionos

* SSH Schlüssel auf Server übertragen:

      ssh-copy-id -i ~/.ssh/ionos.pub root@82.165.21.202
      ssh-copy-id -o PubkeyAuthentication=no -i ~/.ssh/ionos.pub root@82.165.21.202

    * Alternativ den Inhalt vom Public key (`cat ~/.ssh/ionos.pub`) auf dem Server manuell in `nano ~/.ssh/known_hosts`
      hinzufügen.

* SSH Verbindung testen:

      ssh -i ~/.ssh/ubuntu_keyfile localadmin@134.60.33.8

* SSH
  Security [konfigurieren](https://www.cyberciti.biz/tips/linux-unix-bsd-openssh-server-best-practices.html): `sudo nano /etc/ssh/sshd_config`

      Port 22
      Protocol 2
      HostKey /etc/ssh/ssh_host_rsa_key
      HostKey /etc/ssh/ssh_host_ecdsa_key
      HostKey /etc/ssh/ssh_host_ed25519_key

      # Logging
      SyslogFacility AUTH
      LogLevel INFO

      # disaple port forwarding
      AllowTcpForwarding no
      AllowStreamLocalForwarding no
      GatewayPorts no
      PermitTunnel no

      # 2. disable root login
      PermitRootLogin no
      ChallengeResponseAuthentication no
      PasswordAuthentication no
      UsePAM no

      # 3. disable password-based logins
      AuthenticationMethods publickey
      PubkeyAuthentication yes

      # 5. disable empty passwords
      PermitEmptyPasswords no

      # 13. user idle timeout
      ClientAliveInterval 3600
      ClientAliveCountMax 3

      # 15. don’t read the user’s ~/.rhosts and ~/.shosts files
      IgnoreRhosts yes

      # 16. disable host-based authentication
      HostbasedAuthentication no
      
      # nur falls 'Received disconnect from 82.165.21.202 port 22:2: Too many authentication failures'
      MaxAuthTries 10


* Konfiguration prüfen:

      sudo sshd -T

* SSH neustarten:

      /etc/init.d/ssh restart

* Testen ob man sich anmelden kann.

      ssh -i ~/.ssh/ionos root@82.165.21.202
