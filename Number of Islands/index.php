class Solution {

    /**
     * @param String[][] $grid
     * @return Integer
     */
    function numIslands($grid) {
        $count = 0;

        for($x = 0; $x < count($grid); $x++) {
            for($y = 0; $y < count($grid[0]); $y++) {
                if($grid[$x][$y] == '1') {  // Use == for comparison
                    $count += 1;
                    $this->callIslandMethod($grid, $x, $y);  // Correct method call
                }
            }
        }

        return $count;
    }

    private function callIslandMethod(&$grid, $x, $y) {
        if($x < 0 || $y < 0 || $x >= count($grid) || $y >= count($grid[0]) || $grid[$x][$y] == '0') {
            return;  // Correct condition and return type
        }

        $grid[$x][$y] = '0';  // Mark the cell as visited

        $this->callIslandMethod($grid, $x, $y + 1);  // right
        $this->callIslandMethod($grid, $x, $y - 1);  // left
        $this->callIslandMethod($grid, $x + 1, $y);  // down
        $this->callIslandMethod($grid, $x - 1, $y);  // up
    }
}
