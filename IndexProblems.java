import java.util.Scanner;

public class IndexProblems {
    public static void main(String[] args) {
        Scanner in = new Scanner(System.in);

        // Input string (harus tidak kosong)
        String testString;
        while (true) {
            System.out.print("Enter a string: ");
            testString = in.nextLine();
            if (testString.isEmpty()) {
                System.out.println("Error: String tidak boleh kosong. Coba lagi.");
            } else {
                break;
            }
        }

        int start = -1, end = -1;
        boolean valid = false;

        // Input indeks dengan validasi
        while (!valid) {
            try {
                System.out.print("Enter a start index: ");
                start = in.nextInt();

                System.out.print("Enter an end index: ");
                end = in.nextInt();

                // Validasi aturan indeks
                if (start < 0 || end < 0) {
                    System.out.println("Error: Indeks tidak boleh negatif. Coba lagi.");
                } else if (start > end) {
                    System.out.println("Error: Start index tidak boleh lebih besar dari end index. Coba lagi.");
                } else if (end > testString.length()) {
                    System.out.println("Error: End index melebihi panjang string (" + testString.length() + "). Coba lagi.");
                } else {
                    valid = true; // jika semua validasi lolos
                }

            } catch (Exception e) {
                System.out.println("Error: Indeks harus berupa bilangan bulat. Coba lagi.");
                in.nextLine(); // bersihkan input buffer
            }
        }

        // Jika sudah valid
        String result = testString.substring(start, end);
        System.out.println("Your substring is: " + result);
    }
}
