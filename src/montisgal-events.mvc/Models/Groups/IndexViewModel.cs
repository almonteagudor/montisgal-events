namespace montisgal_events.mvc.Models.Groups;

public class IndexViewModel(List<domain.Groups.Group> groups)
{
    public List<domain.Groups.Group> Groups { get; set; } = groups;
}