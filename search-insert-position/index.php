class Solution {
    public function searchInsert($a, $target) {
        $n = count($a);
        $min = 0;
        $max = $n - 1;

        while ($min <= $max) {
            $mid = floor(($max + $min) / 2);
            if ($a[$mid] < $target) {
                $min = $mid + 1;
            } elseif ($a[$mid] > $target) {
                $max = $mid - 1;
            } else {
                return $mid;
            }
        }
        return $max + 1;
    }
}

// Example usage:
$solution = new Solution();
$array = [1, 3, 5, 6];
$target = 5;
echo $solution->searchInsert($array, $target); // Output: 2
